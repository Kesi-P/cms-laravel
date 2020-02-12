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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/blog/posts/{post}','Blog\PostsController@show')->name('blog.posts'); //single post page = Blog/PostsController, url need to be unique ar else it won't show anything
Route::get('blog/category/{category}', 'Blog\PostsController@category')->name('blog.category');
Route::get('blog/tag/{tag}', 'Blog\PostsController@tag')->name('blog.tag');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
  Route::get('/home', 'HomeController@index')->name('home'); //creat the homepage
  //register all the route from category and see the route by route:list
  Route::resource('categories','CategoriesController'); //index page will be home/categories
  Route::resource('posts','PostsController');
  Route::resource('tags','TagsController');
  Route::get('trashed-post','PostsController@trashed');  //register new route cuz resource doesn't provide ,on index file
  Route::put('restore-post/{post}','PostsController@restore'); //put use for security path, people can't direct it from url(like get or post)
  Route::get('user/profile','UsersController@profile')->name('user.profile');
  Route::put('user/profile','UsersController@updateprofile')->name('users.update-profile'); //don't need to pass user id as auth goona check the id for us
});

Route::group(['middleware' => ['auth','VerifyisAdmin']], function () {
  Route::get('user','UsersController@index');
  Route::post('user/{user}/become-admin','UsersController@beAdmin')->name('user.become-admin');
});
