<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'PostController@index')->name('allPosts');
Route::get('/post/{post:id}', 'PostController@show')->name('post');
//Route::get('/vue/post/{post:id}', 'PostController@showVue')->name('postVue');
Route::post('/post/{id}/comment', 'CommentController@store');
Route::post('/post/{id}/reply', 'CommentController@reply');
