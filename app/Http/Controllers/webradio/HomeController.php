<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('webradio.home.home');
    }


    //Route utiliser avec ajax
     public function getUserData() {

        return response()->json(['user'=>Auth::check()])->header('Content-Type','application/json');

     }
}
