<?php

namespace App\Http\Controllers\webradio;

use App\Http\Controllers\Controller;
use App\Http\Resources\webradio\UserDataResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
   
    public function userData(Request $request) {
      
        return UserDataResource::collection(User::all());
    }
}
