<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Models\webradio\Article;
use App\Models\webradio\Categorie;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index() {

        $categories=Categorie::orderBy('id')->get();

        return view('webradio.home.home',['categories'=>$categories]);
    }

    public function show(Article $article,string $slug) {

        return view('webradio.home.show',['article'=>$article]);
    }


    //Route utiliser avec ajax pour envoyer les informations de l'utilisateur
     public function getUserData() {

        return response()->json(['user'=>Auth::check()])->header('Content-Type','application/json');

     }

    /**
     * Pour la gestion des requetes avec htmx
     *Pour afficher l'editeur
     * @param Request $request
     * @return mixed
     */
    public function getHtmxData(Request $request,Article $article) {
        $isHtmxRequest=$request->header('hx-request')==='true';

        return view('webradio.home.htmx',
        [
            'isHtmxRequest'=>$isHtmxRequest,
            'article'=>$article
        ]);
    }
}
