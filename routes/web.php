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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('//photos', 'PhotoController@index');
Route::post('/photos', 'PhotoController@store')->middleware(\App\Http\Middleware\CheckAge::class)->name('post.photos');

//Route::resource('photos', 'PhotoController');

Route::get('profile', function () {
    return 'profile';
})->middleware('verified');
