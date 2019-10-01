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

Route::group(['middleware' => ['auth']], function () {
  Route::get('/home', 'HomeController@index')->name('home'); //creat the homepage
  //register all the route from category and see the route by route:list
  Route::resource('categories','CategoriesController'); //index page will be home/categories
  Route::resource('posts','PostsController');
  Route::resource('tags','TagsController');
  Route::get('trashed-post','PostsController@trashed');  //register new route cuz resource doesn't provide ,on index file
  Route::put('restore-post/{post}','PostsController@restore'); //put use for security path, people can't direct it from url(like get or post)

});
