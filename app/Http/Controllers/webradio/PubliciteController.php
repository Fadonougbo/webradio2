<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Requests\webradio\PubliciteRequest;
use Illuminate\Http\Request;

class PubliciteController extends Controller
{
    public function index() {
        
        return view('webradio.service.publicite.publicite');
    }

    public function create(PubliciteRequest $request) {
        $request->validated();
        
        $userDate=$request->validated('pub_date');

        $periode=$request->validated('pub_periode');


        $user_period=new \DateTime('6:45:00 2024-5-17');

        /* $valide_periode=new \DateTime('6:45:00 2024-5-18');

        $res=now()->setDateTimeFrom($valide_periode)->diff($user_period); */

       /*  if(now('africa/porto-novo')->setDateTimeFrom($user_period)->isToday()) { */
            
            $user_period=new \DateTime('00:00:00 2024-5-17',new \DateTimeZone('africa/porto-novo') );

            //$valide_periode=new \DateTime('19:45:00 2024-5-17');

            $res=now('africa/porto-novo')->diff($user_period);

            /* if($res->invert===1 && $res->h>=3) {

                dump('isValide 1');

            }else if */if ($res->invert===0 && $res->h>=3) {

                dump('isValide 2','');

            }else {

                dump('invalide',"n'est plus possible");
            }

            /* if($res->invert===0 && $res->h>=3) {
                dump('isValide 2','');
            }else {
                dump('invalide',"");
            } */

            /* if($res->invert===0 ) {
                dump('invalide','date superieur');
            } */

            dump($res);

       /*  }else {

            $user_period=new \DateTime('00:45:00 2024-5-18');

            $res=now()->diff($user_period);

            if($res->h>=3) {
                dump('isValide','pour demain');
            }else {
                dump('invalide','pour demain');
            }

        } */

       /* invet ok */


    }
}
