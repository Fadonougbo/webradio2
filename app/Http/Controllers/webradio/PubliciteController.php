<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\webradio\PubliciteRequest;
use App\Models\Publicite;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PubliciteController extends Controller
{
    public function index(Request $request) {


        return view('webradio.service.publicite.publicite');
    }

    public function paiment(Request $request) {
        dump($request->all());
        return view('webradio.service.shared.paiment.paiment');
    }

    public function create(PubliciteRequest $request) {


        $fields=$request->validated();

        

        // si le paiment est valider j'enregistre et j'envoi id de la demande et le nombre de demande
        //return redirect()->route('service.publicite.paiment')->with(['demande_id'=>1,'backUrl'=>route('service.publicite'),'nb_demande'=>3,'amount'=>5000]);
            
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
      
        $publication=Publicite::create($fields);

        if($publication->exists()) {
            
        }


       

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
