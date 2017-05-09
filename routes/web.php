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

Route::get('/',[
   'uses' => 'PostController@getFrontPage',
   'as' => 'homelysa'
 ]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/frontpage',[
   'uses' => 'PostController@getFrontPage',
   'as' => 'frontpage'
 ]);


 Route::get('/singlepost/{id}', ['uses' =>'PostController@getSinglePost','as'=>'singlepost'])->where('id','[\d]+');
  Route::get('/dashboard',[
     'uses' => 'PostController@getDashboard',
     'as' => 'dashboard',
     'middleware'=>'auth'
   ]);

   Route::get('/post',function() {
       return view('post');
   })->name('post');



//we use post if we come from a form
   Route::post('/createpost',[
       'uses'=>'PostController@postCreatePost',
       'as'=>'post.create',
       'middleware'=>'auth' //only can create post if logged in
   ]);

   //we use get  if we come from a link
   Route::get('/deletepost/{post_id}',[
       'uses'=>'PostController@getDeletePost',
       'as'=>'post.delete',
       'middleware'=>'auth' //only can delete post if logged in
   ]);

   Route::post('/edit',[
       'uses'=>'PostController@postEditPost',
       'as'=>'edit'
   ]);

   Route::post('/like', [
    'uses' => 'PostController@postLikePost',
    'as' => 'like'
]);

Route::post('/showMore', [
 'uses' => 'PostController@getShowMorePost',
 'as' => 'showMore'
]);

//CommentsController

Route::post('comments/{post_id}', [
 'uses' => 'CommentsController@store',
 'as' => 'comments.store'
]);
