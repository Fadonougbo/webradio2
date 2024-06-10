<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\webradio\CreateCommuniqueFormRequest;
use App\Models\webradio\Communique;
use Illuminate\Http\Request;

class CommuniqueController extends Controller
{
    public function index(Request $request) {

        $communique=new Communique();

        return view('webradio.service.communique.communique',[
            'communique'=>$communique
        ]);
    }

    public function create(CreateCommuniqueFormRequest $request) {
        
        dd($request->validated());
    }

    public function getHtmxData(Request $request) {
        $isHtmxRequest=$request->header('hx-request')==='true';

        return view('webradio.service.communique.htmx',
        [
            'isHtmxRequest'=>$isHtmxRequest
        ]);
    }
}
