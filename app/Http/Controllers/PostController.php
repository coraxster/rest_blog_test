<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
	public function __construct()
    {
        $this->middleware('token_auth');
    }

    public function listPosts(Request $request){
    	return Auth::user()->posts()->get();
    }
}
