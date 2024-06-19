<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{
    public function index() {
        return view('webradio.home.home');
    }


    //Route utiliser avec ajax pour envoyer les informations de l'utilisateur
     public function getUserData() {

        return response()->json(['user'=>Auth::check()])->header('Content-Type','application/json');

     }
}
