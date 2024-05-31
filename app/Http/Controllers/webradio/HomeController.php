<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function index() {
        return view('webradio.home.home');
    }
}
