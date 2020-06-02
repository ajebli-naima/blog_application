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
/*
Route::get('/hello', function () {
 
  return 'HELLO WORLD';
});
Route::get('/users/{id}', function($id) {
  return 'This is the user '.$id;
});
*/

Route::get('/','PagesController@index');
Route::get('/about','PagesController@about');


Route::resource('posts', 'PostsController');

//Route::resource('/admin/users', 'UserController',['except' => ['create', 'show','store']]);

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
;

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function() {
  Route::resource('/users','UserController',['except' => ['show', 'create' ,'store']]);
});


