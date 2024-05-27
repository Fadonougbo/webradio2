<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\webradio\PubliciteRequest;
use App\Models\Publicite;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PubliciteController extends Controller
{
    public function index() {

        return view('webradio.service.publicite.publicite');
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
        $store_image=$request->validated("pub_file")??null;


        //generate image path
        $imagePath=$this->getImagePath($store_image,$store_files_directory_name);

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


    }

    public function delete(Publicite $publicite) {
        
        $isDeleted=$publicite->delete();

        if($isDeleted) {
            return redirect()->route('dashboard')->with('is_delete',true);
        }

        return redirect()->route('dashboard')->with('is_delete',false);
    }


    private function getImagePath(UploadedFile|null $store_image,string $store_files_directory_name):array {

        $imagePath=[];

        //Case: image is not uploaded and store is not configured or image not exist in DB
        if(empty($store_image)) {

            $imagePath["pub_file"]=null;

        }

        //Case:image is not uploaded and old image exist in DB
        if(empty($store_image) && !empty(Auth::user()->store->store_image) ) {

           unset($imagePath["pub_file"]);

        }

        //Case image is uploades and any image not exist in DB

        if( 
            $store_image && 
            $store_image->isValid() && 
            $store_image->getError()===UPLOAD_ERR_OK &&
            empty(Auth::user()->store?->store_image)
        ) {
            $imagePath["pub_file"]=$store_image->store($store_files_directory_name,'public');

        }


        //Case:image is uploaded and old image exist in DB
  
        if( 
            $store_image && 
            $store_image->isValid() && 
            $store_image->getError()===UPLOAD_ERR_OK &&
            !empty(Auth::user()->store->store_image)
        ) {

            $path=Auth::user()->store->store_image;

            //Delete old image
            Storage::disk('public')->delete($path);

            $imagePath["pub_file"]=$store_image->store($store_files_directory_name,'public');

        }

        return $imagePath;

    }

}
