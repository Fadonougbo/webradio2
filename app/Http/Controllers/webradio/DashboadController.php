<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\webradio\AdminActionRequest;
use App\Http\Requests\webradio\ChangePriceRequest;
use App\Models\Service;
use App\Models\webradio\Communique;
use Auth;
use Illuminate\Http\Request;

class DashboadController extends Controller
{
    //Show user dashboard
    public function index() {

        $communiques=Auth::user()->communiques()->orderByDesc('id')->get();

        
        return view('dashboard',
        [
            'communiques'=>$communiques
        ]);
    }

    //Show admin dashboard
    public function administration() {

        $communiques=Communique::orderByDesc('id')->get();
        
        return view('administration_dashboard',
        [
            'communiques'=>$communiques
        ]);
    }

    //Change communique status
    public function action(AdminActionRequest $request) {

        $status=$request->validated('status');
        $communiqueIds=array_keys($status);
  
        $response=Communique::findMany($communiqueIds)->each(function(Communique $communique,int $k) use($status) {

            $s=$status[$communique->id];
        
            $communique->communique_status=$s;
            $communique->save();

        });

        
        return redirect()->route('dashboard.administration')->with('success','La modification a été effectuée avec succès.');
    }

    //Configuration home
    public function configuration() {
       
        $services=Service::all();
        return view('configuration_dashboard',['services'=>$services]);
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

        return $res? redirect()->route('dashboard.configuration')->with('success','La modification a été effectuée avec succès.'):redirect()->route('dashboard.configuration')->with('error','Une erreur est survenue lors de la modification. Veuillez réessayer plus tard.');
    }


}
