<?php

use Illuminate\Routing\Router;

/** @var Router $router */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
$router->post('/json/auth', 'TokenController@getToken');

$router->get('/json/list_posts', 'PostController@listPosts');
$router->post('/json/add_post', 'PostController@addPost');
$router->post('/json/edit_post', 'PostController@editPost');
$router->post('/json/delete_post', 'PostController@deletePost');


$router->get('/', function () {
    return view('welcome');
});
