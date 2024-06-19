<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\webradio\CreateCommuniqueFormRequest;
use App\Http\Requests\webradio\UpdateFormRequest;
use App\Models\Service;
use App\Models\webradio\Communique;
use App\Models\webradio\Servicefile;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class CommuniqueController extends Controller
{
    public function index(Request $request) {

         $tmpPath=old('communique_files');

         //Remove path from tmp dir if we have an error
         if(!empty($tmpPath) && is_array($tmpPath)) {

            foreach($tmpPath as $path) {
                $this->removeFile($path);
            }

         }

        $communique=new Communique();
       
        return view('webradio.service.communique.communique',[
            'communique'=>$communique
        ]);
    }

    public function create(CreateCommuniqueFormRequest $request) {
     
        $fields=$request->validated();
       
    
        //create publicite
        $communique=Communique::create($fields);
      
        $response=false;

        if($communique->exists()) {
            
            //associate publicite with user
            $response=$communique->user()->associate(Auth::user())->save();
        }
        
        $programmes=$fields['programmes'];

        

        $programmeIsCreated=false;
        if($response) {
            
            $programmeFields=array_map(function($programme) {
    
                $programmeField['programme_hour']=$programme['hour'];
                $programmeField['programme_date']=$programme['date'];
    
                return $programmeField;
    
            },$programmes); 
               
          //Inserte date and hour in programmes table
           $programmeIsCreated=$communique->programmes()->createMany($programmeFields);
               

        }



        $store_files_directory_name="user.".Auth::id();


        //Create directory
        if( Storage::disk('public')->directoryMissing($store_files_directory_name)) {

            Storage::disk('public')->makeDirectory($store_files_directory_name);
        }

        /**
         * @var string[] $communique_file
         */
        $communique_files=$request->validated("communique_files")??[];
        
        $imagePaths=array_map(function($path) use($store_files_directory_name,$communique) {
            
            /* Move file from temp dir */
            $res=$this->moveFileFromTempDir($path,$store_files_directory_name,$communique);

            if(is_string($res)) {
                return ['path'=>$res];
            }

        },$communique_files);


        //Ajout du path des images dans la base de données
        if(!empty($imagePaths)) {
            $communique->servicefiles()->createMany($imagePaths);

            return redirect()->route('service.payment')->with('success',
            [
                'type'=>'communique',
                'id'=>$communique->id
            ]);
        }

        return  redirect()->route('dashboard')->with('error','Une erreur est survenue. Veuillez réessayer plus tard.');

   
    }

    public function updateView(Communique $communique) {

        return view('webradio.service.communique.update',[
            'communique'=>$communique
        ]);
    }

    public function update(UpdateFormRequest $request,Communique $communique) {
        
        $fields=$request->validated();
            
        $response=false;

        if($communique->exists()) {
            
            //associate publicite with user
            $response=$communique->update($fields);
        }

        $programmeIsDeleted=false;

        //Delete old programme
        if($response) {
            $programmeIsDeleted=$communique->programmes()->delete();
        }

        
        $programmes=$fields['programmes'];


        if($programmeIsDeleted) {
            
            $programmeFields=array_map(function($programme) {
    
                $programmeField['programme_hour']=$programme['hour'];
                $programmeField['programme_date']=$programme['date'];
    
                return $programmeField;
    
            },$programmes); 
               
          //Add new programme
           $communique->programmes()->createMany($programmeFields);
               
           
        }
        
        
        $store_files_directory_name="user.".Auth::id();


        //Create directory
        if( Storage::disk('public')->directoryMissing($store_files_directory_name)) {

            Storage::disk('public')->makeDirectory($store_files_directory_name);
        }

        

        /**
         * @var string[] $communique_file
         */
        $communique_files=$request->validated("communique_files")??[];


        $filePathsFromDB=$communique->servicefiles()->get(['path'])->toArray();

        //Send removed file path
        //Renvoi les fichiers qui sont dans la base de données et qui sont supprimé par l'utilisateur sur l'interface
        $invalidePaths=array_filter($filePathsFromDB,function($element) use($communique_files) {

            $path=pathinfo($element['path'],PATHINFO_BASENAME);

            return !in_array($path,$communique_files);
        });
        
        
        foreach($invalidePaths as $key=>$path) {
            $file=Servicefile::where('path','=',$path);
            $paths=$file->get(['path'])->toArray();
            //Suppression de la DB
            if($file->exists()) {
                $file->delete();
            }

            $localFile=Storage::disk('public');

            //Suppression du fichier sur la disque
            if($localFile->exists( $paths[$key]['path']) ) {

                $localFile->delete( $paths[$key]['path'] );
            }
        }

      

        // Je flat le tableau $filePathsFromDB et je recupere uniquement le nom des fichiers
        $flat_FilePathsFromDB=array_map(function($element){

            return pathinfo($element['path'],PATHINFO_BASENAME);

        },$filePathsFromDB);

       

        //Renvoi un tableau avec le chemin des nouveaux fichiers a ajouter
        $newPaths=array_filter($communique_files,function($element) use($flat_FilePathsFromDB) {

            return !in_array($element,$flat_FilePathsFromDB);
        });

        
        
        $imagePaths=array_map(function($path) use($store_files_directory_name,$communique) {
            
            /* Move file from temp dir */
            $res=$this->moveFileFromTempDir($path,$store_files_directory_name,$communique);

            if(is_string($res)) {
                return ['path'=>$res];
            }

        },$newPaths);


        if(!empty($imagePaths)) {
            $communique->servicefiles()->createMany($imagePaths);

            
        }

        return redirect()->route('dashboard')->with('success','La modification a été effectuée avec succès.');
    }

    public function delete(Communique $communique) {

        $isDeleted=$communique->delete();

        if($isDeleted) {
            return redirect()->route('dashboard')->with('success','Votre communiqué a été supprimé avec succès.');
        }

        return redirect()->route('dashboard')->with('error','Une erreur est survenue lors de la suppression. Veuillez réessayer plus tard.');
    }

    private function moveFileFromTempDir(string $path,string $store_files_directory_name,Communique $communique):string|false {

        $fileNotExist=Storage::disk('public')->missing($path);

        if($fileNotExist) {
            return false;
        }

        $new_path=$store_files_directory_name.DIRECTORY_SEPARATOR.pathinfo($path,PATHINFO_BASENAME);

        $isMoved=Storage::disk('public')->move($path,$new_path);
        

        return $isMoved?$new_path:false;
        

    }

    private function removeFile(string $path):bool {

        if(empty($path)) {
            return false;
        }

        $disk=Storage::disk('public');

        if($disk->missing($path)) {
            return false;
        }

        $res=$disk->delete($path);

        return $res;

    }

    /**
     * Pour l'ajout de fichier avec filpond dans le dossier tmp
     *
     * @param Request $request
     * @return mixed
     */
    public function process(Request $request) {

        /**
         * @var UploadedFile[] $files
         */
        $files=$request->file('communique_files');

        $badExtentions=['php','js'];


        foreach($files as $file) {

            $inBadExtentionArray=in_array($file->getClientOriginalExtension(),$badExtentions);

            abort_if($inBadExtentionArray,500);
        }
        
        $path='';
  
        foreach($files as $file) {
            
            abort_unless($file->isValid(),500);
            abort_unless($file->isFile(),500);
            
            $path=$file->store('tmp','public');
        }
        return response($path,headers:['Content-Type'=>'text/plain']); 
    }

    /**
     * Pour la supression de fichier avec filepond
     *
     * @return mixed
     */
    public function revert() {
         
       $path=file_get_contents('php://input');

       $res=$this->removeFile($path);

       abort_unless($res,500);

        return response('');
    }

    // Send file Info to filePond
    public function loadFile(Request $request) {

        $type=$request->input('type');
        $id=(int)$request->input('id');

        $typeExist=in_array($type,['communique']);

        if(!$typeExist) {
            return response()->json([],headers:['Contente-Type'=>'application/json']);
        }

        $communique=Communique::find($id);

        $files=$communique->servicefiles->toArray();

        $data=array_map(function($file) {
            
            $fileSize=Storage::disk('public')->fileSize($file['path']);

           $arr['source']=pathinfo($file['path'],PATHINFO_BASENAME);
           $arr['options']['type']='local';
           $arr['options']['file']['size']=$fileSize;
           $arr['options']['file']['name']=pathinfo($file['path'],PATHINFO_BASENAME);

           return $arr;

        },$files); 
         
      

        return response()->json($data,headers:['Contente-Type'=>'application/json']);
    }

    /**
     * Pour la gestion des requetes avec htmx
     *
     * @param Request $request
     * @return mixed
     */
    public function getHtmxData(Request $request) {
        $isHtmxRequest=$request->header('hx-request')==='true';

        return view('webradio.service.communique.htmx',
        [
            'isHtmxRequest'=>$isHtmxRequest
        ]);
    }
}
