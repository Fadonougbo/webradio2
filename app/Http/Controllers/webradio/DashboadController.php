<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\webradio\AdminActionRequest;
use App\Http\Requests\webradio\ChangePriceRequest;
use App\Http\Requests\webradio\ChangeRoleRequest;
use App\Models\Service;
use App\Models\User;
use App\Models\webradio\Communique;
use Auth;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboadController extends Controller
{
    //Show user dashboard
    public function index() {

        $communiques=Auth::user()->communiques()->orderByDesc('id')->paginate(perPage:18,pageName:'communique');

        
        return view('dashboard',
        [
            'communiques'=>$communiques
        ]);
    }

    //Show admin dashboard
    public function administration() {

        $communiques=Communique::orderByDesc('id')->paginate(perPage:20,pageName:'communique');
        
        return view('administration_dashboard',
        [
            'communiques'=>$communiques
        ]);
    }

    //Change communique status
    public function action(AdminActionRequest $request) {

        $status=$request->validated('status');
        $communiqueIds=array_keys($status);
  
        Communique::findMany($communiqueIds)->each(function(Communique $communique,int $k) use($status) {

            $s=$status[$communique->id];
        
            $communique->communique_status=$s;
            $communique->save();

        });

        
        return redirect()->route('dashboard.administration')->with('success','La modification a été effectuée avec succès.');
    }

    //Configuration home
    public function configuration() {
       
       $this->removeOldTmpFiles();
        
        

        $services=Service::all();
        return view('configuration_dashboard',['services'=>$services]);
    }

    //Supprime les vieux fichier du dossier tmp
    private function removeOldTmpFiles() {

        $currentDate=(int)now('africa/porto-novo')->format('j');

        //La function de suppression sera lancé  du 25 au 27
        $dateIsValide=$currentDate>=24 && $currentDate<=27;

        if(!$dateIsValide) {

            return false;
        
        }
       

        $disk=Storage::disk('public');

        if(!$disk->exists('tmp')) {
            return false;
        }
    
        $dirData=$disk->files('tmp');

        if(empty($dirData)) {
            return false;
        }


        //Je retourn les fichiers creer avant la date 20
        $res=array_filter($dirData,function($data) use($disk) {
            
            $lastModification=$disk->lastModified($data);

            $date=new DateTime("@{$lastModification}",new \DateTimeZone('africa/porto-novo'));
            
            $fileDate=(int)$date->format('j');
            return $fileDate<20;
        });

        //Je les supprimes
        if(!empty($res)) {

            foreach($res as $path) {
                $disk->delete($path);
            }

        }

    }

    public function price(ChangePriceRequest $request) {
        $name=$request->validated('name');
        $price=$request->validated('price');

        $res=false;
        if($name==='communique') {
            $res=Service::where('name','=',$name)->update([
                'price'=>$price
            ]);
        }

        return $res? redirect()->route('dashboard.configuration')->with('success','La modification a été effectuée avec succès.'):redirect()->route('dashboard.configuration')->with('error','Une erreur est survenue lors de la modification. Veuillez réessayer ultérieurement.');
    }

    public function role(ChangeRoleRequest $request,User $user) {
        
        $user->role=$request->validated('role');

        $res=$user->save();
        
        return $res?redirect()->route('dashboard.configuration')->with('success','Le rôle a été changé avec succès.'):redirect()->route('dashboard.configuration')->with('error',"Le rôle n'a pas été changé ");
    }


    /**
     * Pour la gestion des requetes avec htmx
     *
     * @param Request $request
     * @return mixed
     */
    public function getHtmxData(Request $request) {
        $isHtmxRequest=$request->header('hx-request')==='true';

        return view('htmx',
        [
            'isHtmxRequest'=>$isHtmxRequest
        ]);
    }



}
