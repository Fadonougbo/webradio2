<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvisDeRechercheRequest;
use App\Http\Requests\AvisDeRechercheUpdateRequest;
use App\Models\AvisDeRecherche;
use App\Models\Periode;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AvisDeRechercheController extends Controller
{
    public function index() {

        $adr=new AvisDeRecherche();

        return view('webradio.service.adr.adr',
        [
            'adr'=>$adr
        ]);
      
    }

    public function create(AvisDeRechercheRequest $request) {

        //dd($request->validated());
        $fields=$request->validated();
            
        $store_files_directory_name="user.".Auth::id();


        //Create directory
        if( Storage::disk('public')->directoryMissing($store_files_directory_name)) {

            Storage::disk('public')->makeDirectory($store_files_directory_name);
        }

        /**
         * @var UploadedFile
         */
        $adr_file=$request->validated("adr_file")??null;

        $adr=new AvisDeRecherche();

        //generate image path
        $imagePath=$this->getImagePath($adr_file,$store_files_directory_name,$adr);

        //merge fields data with image path
        $fields=array_merge($fields,$imagePath);

      
      
        //create publicite
        $adr=AvisDeRecherche::create($fields);

        $response=false;

        if($adr->exists()) {
            
            //associate publicite with user
            $response=$adr->user()->associate(Auth::user())->save();
        }

        $programmes=$fields['programme'];

        if($response) {
            
            $programmeFields=array_map(function($programme) {
    
                $programmeField['periode_hour']=$programme['periode'];
                $programmeField['periode_date']=$programme['date'];
    
                return $programmeField;
    
            },$programmes);
               
          //Inserte date and hour in periodes table
           $adr->periodes()->createMany($programmeFields);
               

        }
        

        $price=Service::where('name','=','avis_de_recherche')->get()->first()->price;
        $amount=$price*count($programmes);

        return redirect()->route('dashboard');

         /* return redirect()->route('service.paiment')->with(
        [
            'demande_id'=>$publicite->id,
            'tel'=>$publicite->pub_tel,
            'email'=>$publicite->pub_email,
            'demande_type'=>'publicite',
            'on_error_url'=>route('dashboard',['ispaid'=>'no']),
            'on_success_url'=>route('dashboard',['ispaid'=>'yes']),
            'amount'=>$amount
        ]); */

    }
 

        //return redirect()->route('dashboard');
        


       

        //dd($fields);

        ///////////////////////////////////////////
        /* $user_period=new \DateTime('6:45:00 2024-5-17');

        $user_period=new \DateTime('00:00:00 2024-5-17',new \DateTimeZone('africa/porto-novo') );

        $res=now('africa/porto-novo')->diff($user_period);

        
        if ($res->invert===0 && $res->h>=3) {

            dump('isValide 2','');

        }else {

            dump('invalide',"n'est plus possible");
        }

            
        dump($res); */


    



    public function update(Request $request,AvisDeRecherche $adr) {
        $id=(int)$request->route()->parameter('avisDeRecherche');
        
        $adr=(AvisDeRecherche::where('id','=',$id)->get())[0];
        
        return view('webradio.service.adr.update',
        [
            'adr'=>$adr
        ]);
    }

    public function updateValidation(AvisDeRechercheUpdateRequest $request,AvisDeRecherche $adr) {

        
        $id=(int)$request->route()->parameter('avisDeRecherche');
        
        $adr=(AvisDeRecherche::where('id','=',$id)->get())[0];

        $fields=$request->validated();
        
            
        $store_files_directory_name="user.".Auth::id();

       

        //Create directory
        if( Storage::disk('public')->directoryMissing($store_files_directory_name)) {

            Storage::disk('public')->makeDirectory($store_files_directory_name);
        }

        /**
         * @var UploadedFile
         */
        $adr_image=$request->validated("adr_file")??null;


        //generate image path
        $imagePath=$this->getImagePath($adr_image,$store_files_directory_name,$adr);

        //merge fields data with image path
        $fields=array_merge($fields,$imagePath);

        
      
        //update publicite
        $publiciteIsUpdated=$adr->update($fields);


        

        $isDeleted=false;

        if($publiciteIsUpdated) {

            $isDeleted=Periode::where('avis_de_recherche_id','=',$adr->id)->delete();

        }

        if($isDeleted) {
            $programmes=$fields['programme'];
            $programmeFields=array_map(function($programme) {
    
                $programmeField['periode_hour']=$programme['periode'];
                $programmeField['periode_date']=$programme['date'];
    
                return $programmeField;
    
            },$programmes);
               
          //Inserte date and hour in periodes table
           $adr->periodes()->createMany($programmeFields);

        }

        
         return redirect()->route('dashboard')->with('success_update','');


    }

    public function delete(AvisDeRecherche $adr,Request $request) {
       
        $id=(int)$request->route()->parameter('avisDeRecherche');
        $isDeleted=$adr->find($id)->delete();

        
        if($isDeleted) { 
            return redirect()->route('dashboard')->with('is_delete',true);
        }

        return redirect()->route('dashboard')->with('is_delete',false);
    }


    private function getImagePath(UploadedFile|null $adr_file,string $store_files_directory_name,AvisDeRecherche $adr):array {

        $imagePath=[];

        //Case: image is not uploaded and store is not configured or image not exist in DB
        if(empty($adr_file)) {

            $imagePath["adr_file"]=null;

        }

        //Case:image is not uploaded and old image exist in DB
        if(empty($adr_file) && !empty($adr->adr_file) ) {

           unset($imagePath["adr_file"]);

        }

        //Case image is uploades and any image not exist in DB

        if( 
            $adr_file && 
            $adr_file->isValid() && 
            $adr_file->getError()===UPLOAD_ERR_OK &&
            empty($adr?->adr_file)
        ) {
            $imagePath["adr_file"]=$adr_file->store($store_files_directory_name,'public');

        }


        //Case:image is uploaded and old image exist in DB
  
        if( 
            $adr_file && 
            $adr_file->isValid() && 
            $adr_file->getError()===UPLOAD_ERR_OK &&
            !empty($adr?->adr_file) 
        ) {

            $path=$adr?->adr_file;

            //Delete old image
            Storage::disk('public')->delete($path);

            $imagePath["adr_file"]=$adr_file->store($store_files_directory_name,'public');

        }

        return $imagePath;

    }

}
