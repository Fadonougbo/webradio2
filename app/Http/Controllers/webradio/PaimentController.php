<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Models\Publicite;
use App\Models\Service;
use Illuminate\Http\Request;

class PaimentController extends Controller
{
    public function paiment() {
       
        return view('webradio.service.shared.paiment.paiment');
    }

    public function redirect(Publicite $publicite) {

            $price=Service::where('name','=','publicité')->get()->first()->price;
            $amount=$price * $publicite->periodes->count();
            

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

    public function paimentValidation(Request $request) {
       
        $type=$request->input('demande_type');
        $id=(int)$request->input('demande_id');

        $res=false;
        if($type==='publicite') {
            
            $res=Publicite::find($id)->update([
                'isPaid'=>true
            ]);

        }

        return $res?redirect()->route('dashboard')->with('paiment_success',true):redirect()->route('dashboard')->with('paiment_error',false);

    }
}
