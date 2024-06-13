<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class DashboadController extends Controller
{
    public function index() {
        $communiques=Auth::user()->communiques()->orderByDesc('id')->get();

        
        return view('dashboard',
        [
            'communiques'=>$communiques
        ]);
    }
}
