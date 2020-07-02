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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::resource('categories', 'CategoriesController');

// Route::resource('posts', 'PostsController')->middleware(['auth']);

// Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');

// Route::put('restore-post/{post}', 'PostsController@restore')->name('restore-posts');

/**
 * This is validating if user are login
 */
Route::middleware(['auth'])->group(function (){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('categories', 'CategoriesController');

    Route::resource('posts', 'PostsController');
    
    Route::get('trashed-posts', 'PostsController@trashed')->name('trashed-posts.index');

    Route::put('restore-post/{post}', 'PostsController@restore')->name('restore-posts');

    Route::resource('tags', 'TagsController');

});

/**
 * This is validating if the login user is an admin and allow the user access to the page
 */
Route::middleware(['admin', 'auth'])->group(function (){
   Route::get('users', 'UsersController@index')->name('users.index'); 
   Route::post('users/{user}/make-admin', 'UsersController@makeadmin')->name('make.admin');
});



