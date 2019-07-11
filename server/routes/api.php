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


Route::get('categories', \App\App\Categories\Actions\CategoryIndexAction::class)->name('categories.index');
Route::get('ads', \App\App\Advertisements\Actions\AdvertisementIndexAction::class)->name('advertisements.index');
Route::get('ads/{advertisement}', \App\App\Advertisements\Actions\AdvertisementShowAction::class)->name('advertisements.show');

Route::group(['prefix' => 'auth'], function() {
    Route::post('login', \App\App\Auth\Actions\UserLoginAction::class)->name('login');
    Route::post('register', \App\App\Auth\Actions\UserRegisterAction::class)->name('register');
});
