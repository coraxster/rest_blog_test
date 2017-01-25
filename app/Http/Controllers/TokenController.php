<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function getToken(Request $request){
    	Auth::once(['email' => $request->email, 'password' => $request->password]);
    	if (Auth::check()) {
		    return Auth::user()->resetToken()->token;
		}
    	abort(403);
    }
}
