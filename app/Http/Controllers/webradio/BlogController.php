<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function create () {
        
        return view('webradio.blog.blog');
    }
}
