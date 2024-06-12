<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\webradio\CreateCommuniqueFormRequest;
use App\Models\webradio\Communique;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class CommuniqueController extends Controller
{
    public function index(Request $request) {
         
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


        if($response) {
            
            $programmeFields=array_map(function($programme) {
    
                $programmeField['programme_hour']=$programme['hour'];
                $programmeField['programme_date']=$programme['date'];
    
                return $programmeField;
    
            },$programmes); 
               
          //Inserte date and hour in programmes table
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
        
        $imagePaths=array_map(function($path) use($store_files_directory_name,$communique) {
            
            /* Move file from temp dir */
            $res=$this->moveFileFromTempDir($path,$store_files_directory_name,$communique);

            if(is_string($res)) {
                return ['path'=>$res];
            }

        },$communique_files);


        if(!empty($imagePaths)) {
            $communique->servicefiles()->createMany($imagePaths);

            return redirect()->route('dashboard')->with('success','Le communiqué à bien été envoyé ');
        }

  


        //$price=Service::where('name','=','publicité')->get()->first()->price;
        //$amount=$price*count($programmes);

        return  redirect()->route('dashboard')->with('error','Une erreur est survenue, essayer plus tard');

   
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

    /**
     * Pour l'ajout de fichier avec filpond
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

       if(!empty($path)) {
            Storage::disk('public')->delete($path);
       }

        return response('');
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
