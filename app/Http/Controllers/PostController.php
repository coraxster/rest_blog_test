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
    	$this->validate($request, [
		    'On_page' => 'integer|min:1',
		    'Order_by' => 'in:id,title,created_at',
		    'Order_direction' => 'in:asc,desc',
		    'Post_type' => 'in:post,draft'
		]);

    	$scope = Auth::user()->posts();

    	if ($request->has('On_page')){
    		$scope->take($request->On_page);
    	}

    	if ($request->has('Order_by')){
    		if ($request->has('Order_direction')){
	    		$scope->orderBy($request->Order_by, $request->Order_direction);
	    	}else{
	    		$scope->orderBy($request->Order_by);
	    	}
    	}

    	if ($request->has('Post_type')){
    		$scope = $scope->PostType($request->Post_type);
    	}

    	return $scope->get();
    }

    public function addPost(Request $request){
    	$this->validate($request, [
    		'props_json' => 'json',
    		'created_at' => 'date',
    		'post_type' => 'in:post,draft', 
		]);
    	return Auth::user()->posts()->create($request->toArray());
    }

    public function editPost(Request $request){
    	$this->validate($request, [
    		'props_json' => 'json',
    		'created_at' => 'date',
    		'post_type' => 'in:post,draft', 
    		'post_id' => 'exists:Items,item_id'
		]);
		$post = Auth::user()->posts()->where(['item_id' => $request->post_id])->firstOrFail();
		if ($post->update($request->toArray())){
			return $post;
		}else{
			return 'error';
		}
    }

    public function deletePost(Request $request){
    	$post = Auth::user()->posts()->where(['item_id' => $request->post_id])->firstOrFail();
    	if ($post->delete()){
    		return 'ok';
    	}else{
    		return 'error';
    	}
    }




}
