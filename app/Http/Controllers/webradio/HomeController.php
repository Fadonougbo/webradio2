<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Models\webradio\Article;
use App\Models\webradio\Categorie;
use Auth;
use DateTime;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index() {

        $categories=Categorie::orderBy('id')->get();


        $firstCategorie=$categories[0];

        $firstCategorieId=$firstCategorie->id;

        $otherCategories=$categories->where('id','!=',$firstCategorieId);

        return view('webradio.home.home',['otherCategories'=>$otherCategories,'firstCategorie'=>$firstCategorie,]);
    }

    public function show(Article $article,string $slug) {

        if($article->article_slug !== $slug) {
            return redirect()->route('home.show',['article'=>$article,'slug'=>$article->article_slug]);
        }

        $nextArticle=$article->forPageAfterId(1,$article->id)->get()->first();


        return view('webradio.home.show',['article'=>$article,'nextArticle'=>$nextArticle]);
    }

    public function showCategorie(Categorie $categorie,string $name) {

        if($categorie->name !== $name) {
            return redirect()->route('home.show.categorie',['categorie'=>$categorie,'name'=>$categorie->name]);
        }

        $categories=Categorie::all(['name','id']);

        return view('webradio.home.filtre_categorie',['categorie'=>$categorie,'categories'=>$categories]);
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

     /**
     * Pour la gestion des requetes avec htmx
     *Pour afficher le carousel
     * @param Request $request
     * @return mixed
     */
    public function getCarouselHtmxData(Request $request) {

        $isHtmxRequest=$request->header('hx-request')==='true';

        return view('webradio.home.carousel_htmx',
        [
            'isHtmxRequest'=>$isHtmxRequest
        ]);
    }
}
