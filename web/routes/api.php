<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * 認証
 */
Route::get('/refresh-token', function (Request $request) {
    $request->session()->regenerateToken();
    return response()->json();
});
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/user', fn() => Auth::user())->name('user');

Route::post('/photos/{photo}/comments', 'PhotoController@addComment')->name('photo.comment');
Route::put('/photos/{id}/like', 'PhotoController@like')->name('photo.like');
Route::delete('/photos/{id}/like', 'PhotoController@unlike')->name('photo.like');
Route::get('/photos', 'PhotoController@index')->name('photo.index');
Route::post('/photos', 'PhotoController@create')->name('photo.create');
Route::get('/photos/{id}', 'PhotoController@show')->name('photo.show');
