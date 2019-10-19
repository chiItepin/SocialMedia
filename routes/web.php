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


Auth::routes();

// add a comment to post
Route::post('/comment/{post}', 'CommentsController@store');

// retrieve COMMENTS of posts
Route::get('/commented/{post}/{offset}', 'CommentsController@show');

// retrieve profile
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');

// EDIT PROFILE
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');

// UPDATE PROFILE
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

// FFOllow user
 Route::post('/follow/{user}', 'FollowsController@store');

 // LIKE POST
 Route::post('/like/{post}', 'LikesController@store');

// POST ACTION para enviar formulario
Route::post('/p', 'PostsController@store');

// FORM PARA CREAR POST MUUUUUUUY IMPORTANTE EL ORDEN, QUE ESTE ESTE PRIMERO QUE EL SIGUIENTE
Route::get('/p/create', 'PostsController@create');

// view post
Route::get('/p/{post}', 'PostsController@show');


// view EVERY post
Route::get('/post/view/{offset}', 'PostsController@showindex');

// view EVERY post of a profile
Route::get('/post/profile/{user}/{offset}', 'PostsController@profileindex');

// index home of posts
Route::get('/', 'PostsController@index');
