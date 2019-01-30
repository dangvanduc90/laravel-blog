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

// gọi ra trang view demo-pusher.blade.php
Route::get('demo-pusher', 'BroadCastController@getPusher');

// Truyển message lên server Pusher
Route::get('fire-event', 'BroadCastController@fireEvent');

// commands
Route::get('/commands', function () {
    Artisan::call('ninegag', [
        'user' => 'dangvanduc90',
        '--queue' => 'default queue'
    ]);
});

// event
Route::get('/events', 'HomeController@ship');

// File Storage
Route::get('/upload-file-storage', 'HomeController@uploadFileStorage');

// File Storage
Route::post('/file-storage', 'HomeController@fileStorage')->name('upload.file.storage');

// Collections & Relationships
Route::get('/collections', 'HomeController@collections');

// Mutators
Route::get('/mutators', 'HomeController@mutators');

// API Resources
Route::get('/products/{id}', 'HomeController@show');

// Blade
Route::get('blade', 'HomeController@blade');

// Views
Route::get('views', 'HomeController@views');

// Validation
Route::get('create-post', 'PostController@create');
Route::post('create-post', 'PostController@store');

Route::get('notification', 'UserController@notification');

// Cashier
Route::get('/plans', 'PlansController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/plan/{plan}', 'PlansController@show');
    Route::get('/braintree/token', 'BraintreeTokenController@token');
    Route::post('/subscribe', 'SubscriptionsController@store');
});

Route::get('/nganluong', 'NganLuongController@index');
Route::get('/baokim', 'BaokimController@index');
Route::resource('/paypal', 'PaypalController');
Route::post('/paypal/store', 'PaypalController@store');
Route::get('/paypal/success', 'PaypalController@success');
Route::get('/paypal/error', 'PaypalController@error');
