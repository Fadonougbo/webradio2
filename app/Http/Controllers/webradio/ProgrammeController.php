<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    public function index(Request $request) {
        
        return view('webradio.programme.programme');
    }
}
