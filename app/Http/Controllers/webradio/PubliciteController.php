<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\webradio\PubliciteRequest;
use App\Http\Requests\webradio\UpdatePubliciteRequest;
use App\Models\Periode;
use App\Models\Publicite;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PubliciteController extends Controller
{
    public function index() {

        $publicite=new Publicite();

        return view('webradio.service.publicite.publicite',
        [
            'publicite'=>$publicite
        ]);
    }



    public function create(PubliciteRequest $request) {


        $fields=$request->validated();
            
        $store_files_directory_name="user.".Auth::id();


        //Create directory
        if( Storage::disk('public')->directoryMissing($store_files_directory_name)) {

            Storage::disk('public')->makeDirectory($store_files_directory_name);
        }

        /**
         * @var UploadedFile
         */
        $pub_file=$request->validated("pub_file")??null;

        $publicite=new Publicite();

        //generate image path
        $imagePath=$this->getImagePath($pub_file,$store_files_directory_name,$publicite);

        //merge fields data with image path
        $fields=array_merge($fields,$imagePath);

      
      
        //create publicite
        $publicite=Publicite::create($fields);

        $response=false;

        if($publicite->exists()) {
            
            //associate publicite with user
            $response=$publicite->user()->associate(Auth::user())->save();
        }

        $programmes=$fields['programme'];

        if($response) {
            
            $programmeFields=array_map(function($programme) {
    
                $programmeField['periode_hour']=$programme['periode'];
                $programmeField['periode_date']=$programme['date'];
    
                return $programmeField;
    
            },$programmes);
               
          //Inserte date and hour in periodes table
           $publicite->periodes()->createMany($programmeFields);
               

        }


        $price=Service::where('name','=','publicité')->get()->first()->price;
        $amount=$price*count($programmes);

         return redirect()->route('service.paiment')->with(
        [
            'demande_id'=>$publicite->id,
            'tel'=>$publicite->pub_tel,
            'email'=>$publicite->pub_email,
            'demande_type'=>'publicite',
            'on_error_url'=>route('dashboard',['ispaid'=>'no']),
            'on_success_url'=>route('dashboard',['ispaid'=>'yes']),
            'amount'=>$amount
        ]);

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


    



    public function update(Publicite $publicite) {

        return view('webradio.service.publicite.update',
        [
            'publicite'=>$publicite
        ]);
    }

    public function updateValidation(UpdatePubliciteRequest $request,Publicite $publicite) {

        
        $fields=$request->validated();
        
            
        $store_files_directory_name="user.".Auth::id();

       

        //Create directory
        if( Storage::disk('public')->directoryMissing($store_files_directory_name)) {

            Storage::disk('public')->makeDirectory($store_files_directory_name);
        }

        /**
         * @var UploadedFile
         */
        $pub_image=$request->validated("pub_file")??null;


        //generate image path
        $imagePath=$this->getImagePath($pub_image,$store_files_directory_name,$publicite);

        //merge fields data with image path
        $fields=array_merge($fields,$imagePath);

        
      
        //update publicite
        $publiciteIsUpdated=$publicite->update($fields);


        

        $isDeleted=false;

        if($publiciteIsUpdated) {

            $isDeleted=Periode::where('publicite_id','=',$publicite->id)->delete();

        }

        if($isDeleted) {
            $programmes=$fields['programme'];
            $programmeFields=array_map(function($programme) {
    
                $programmeField['periode_hour']=$programme['periode'];
                $programmeField['periode_date']=$programme['date'];
    
                return $programmeField;
    
            },$programmes);
               
          //Inserte date and hour in periodes table
           $publicite->periodes()->createMany($programmeFields);

        }

        
         return redirect()->route('dashboard');

       

        


    }

    public function delete(Publicite $publicite) {
        
        $isDeleted=$publicite->delete();

        if($isDeleted) {
            return redirect()->route('dashboard')->with('is_delete',true);
        }

        return redirect()->route('dashboard')->with('is_delete',false);
    }


    private function getImagePath(UploadedFile|null $pub_file,string $store_files_directory_name,Publicite $publicite):array {

        $imagePath=[];

        //Case: image is not uploaded and store is not configured or image not exist in DB
        if(empty($pub_file)) {

            $imagePath["pub_file"]=null;

        }

        //Case:image is not uploaded and old image exist in DB
        if(empty($pub_file) && !empty($publicite->pub_file) ) {

           unset($imagePath["pub_file"]);

        }

        //Case image is uploades and any image not exist in DB

        if( 
            $pub_file && 
            $pub_file->isValid() && 
            $pub_file->getError()===UPLOAD_ERR_OK &&
            empty($publicite?->pub_file)
        ) {
            $imagePath["pub_file"]=$pub_file->store($store_files_directory_name,'public');

        }


        //Case:image is uploaded and old image exist in DB
  
        if( 
            $pub_file && 
            $pub_file->isValid() && 
            $pub_file->getError()===UPLOAD_ERR_OK &&
            !empty($publicite?->pub_file)
        ) {

            $path=$publicite?->pub_file;

            //Delete old image
            Storage::disk('public')->delete($path);

            $imagePath["pub_file"]=$pub_file->store($store_files_directory_name,'public');

        }

        return $imagePath;

    }

}
