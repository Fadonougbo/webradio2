<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Models\webradio\Communique;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() {
        return view('webradio.service.shared.payment');
    }

    /* Valide un payment */
    public function validation(Request $request) {


        $request->validate([
            'id'=>['required','string','exists:communiques,id'],
            'type'=>['required','string','exists:services,name'],
            'price'=>['required','integer']
        ]);

        

        $type=$request->input('type');
        $id=(int)$request->input('id');
        $price=(int)$request->input('price');

        $res=false;
        if($type==='communique') {
            
            $communique=Communique::find($id);

            $communique->isPaid=true;
            
            $communique->price=$price;

            $res=$communique->save();
        }
        
        return $res?redirect()->route('dashboard')->with('success','Paiement effectué avec succès'):redirect()->route('dashboard');

    }

    public function oldPaymentValidation(string $id, string $type) {
        
        return redirect()->route('service.payment')->with('success',
        [
            'type'=>$type,
            'id'=>$id
        ]);
    }

    /**
     * Pour la gestion des requetes avec htmx
     *
     * @param Request $request
     * @return mixed
     */
    public function getHtmxData(Request $request) {
        $isHtmxRequest=$request->header('hx-request')==='true';

        return view('webradio.service.shared.htmx',
        [
            'isHtmxRequest'=>$isHtmxRequest
        ]);
    }
}
