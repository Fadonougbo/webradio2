<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index() {
       
        return view('webradio.service.service');

    }
}
