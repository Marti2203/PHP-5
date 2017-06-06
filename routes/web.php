<?php

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
	
Route::get('/LaravelTestPage', function () {
    return view('welcome');
});
Route::get('/Hello', function () {
    return 'Hello World';
});


Auth::routes();

Route::group(['prefix' => 'blogger'], function () {

Route::get('profile/{id}','UserController@view');

Route::get('{name?}/{chunk?}/{size?}', 'PostController@viewName');

Route::get('{id}/{chunk?}/{size?}', 'PostController@viewID');

});


Route::group(['prefix' => 'post'], function () {

Route::get('{id}', 'PostController@viewPost');

Route::group(['middleware' => 'auth'],function(){

Route::get('create','PostController@create');
Route::post('create','PostController@store');

});

});



Route::get('/',function()
{
	return view('main');
});
	
Route::get('/register','UserController@create');
Route::post('/register','UserController@store');
Route::post('/comment/create','CommentController@store');

Route::get('/find','PostController@viewName');

Route::get('/logout',function(){ Auth::logout(); return redirect()->back();});

Route::group(['prefix' => 'Test'],function(){
	
Route::get('/',function() { return view('test'); });
Route::get('blade',function() {return view('testblade');});

});


Route::group(['middleware' => 'admin','prefix' => 'admin'], function () {
	Route::group(['prefix'=>'delete'],function()
	{
		Route::get('tag/{id}','TagController@delete');
		Route::get('comment/{id}','CommentController@delete');
		Route::get('post/{id}','PostController@delete');
		Route::get('post/{post_id}/tag/{tag_id}','PostController@deleteTag')->where('post_id','[0-9]+')->where('tag_id','[0-9]+');
		Route::get('user/{id}', 'UserController@delete');
	});
	Route::group(['prefix'=>'edit'],function()
	{
		Route::get('tag/{id}','TagController@edit');
		Route::get('comment/{id}','CommentController@edit');
		Route::get('post/{id}','PostController@edit');
		Route::get('post/{post_id}/tag/{tag_id}','PostController@editTag')->where('post_id','[0-9]+')->where('tag_id','[0-9]+');
		Route::get('user/{id}', 'UserController@edit');
	});
});


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search/{tag?}/{chunk?}/{size?}','PostController@search')->where('tag','[a-zA-Z_ ]+');

Route::get('/search/{year}/{month?}/{chunk?}/{size?}','PostController@viewDate')->where('year','[0-9]+')->where('month','[0-9]+');
