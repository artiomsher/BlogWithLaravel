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

// Post routes
Route::get('/', 'PagesController@home');
Route::get('/posts', 'PagesController@index')->middleware('auth');
Route::get('/posts/create', 'PagesController@create') ->middleware('auth');
Route::post('/posts', 'PagesController@store');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts/{post}/edit', 'PagesController@edit');
Route::patch('posts/{post}', 'PagesController@update');
Route::delete('posts/{post}', 'PagesController@destroy');

//Comment routes
Route::get('/posts/comments/{comment}/edit', 'CommentsController@edit');
Route::post('/posts/{post}/comments', 'CommentsController@store');
Route::patch('/posts/comments/{comment}', 'CommentsController@update');
Route::delete('/posts/comments/{comment}', 'CommentsController@destroy');