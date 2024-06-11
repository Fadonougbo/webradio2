<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\webradio\CreateCommuniqueFormRequest;
use App\Models\webradio\Communique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommuniqueController extends Controller
{
    public function index(Request $request) {

        $communique=new Communique();
        return view('webradio.service.communique.communique',[
            'communique'=>$communique
        ]);
    }

    public function create(Request $request) {
        dd($request->all());
    }

    public function upload(Request $request) {
       
        return ['ok'=>23];
    }

    public function uploadDelete(Request $request) {
       $x=file_get_contents('php://input');
        return ['ok'=>$x];
    }

    public function uploadload(Request $request) {
       header('Access-Control-Expose-Headers: Content-Disposition');
        header('Content-Disposition: inline; filename="my-f2ile.jpg"');
        //$img=Storage::disk('public')->('user.2/0EDPvDIwdV1rA8ESLtHrxXhHMcKUEPAsCYzoCuRo.jpg');
        
        return json_encode(['source'=> '092w87',
                'options'=>[
                    'type'=> 'local',
                    'file'=>[
                        'name'=> 'my-fiwwle.png',
                        'size'=> 200000,
                        'type'=> 'image/png',
                    ],
        ]]);
    }

    public function getHtmxData(Request $request) {
        $isHtmxRequest=$request->header('hx-request')==='true';

        return view('webradio.service.communique.htmx',
        [
            'isHtmxRequest'=>$isHtmxRequest
        ]);
    }
}
