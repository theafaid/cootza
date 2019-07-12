<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('categories', \App\App\Categories\Actions\CategoryIndexAction::class)->name('categories.index');
Route::get('ads', \App\App\Advertisements\Actions\AdvertisementIndexAction::class)->name('advertisements.index');
Route::get('ads/{advertisement}', \App\App\Advertisements\Actions\AdvertisementShowAction::class)->name('advertisements.show');

//Route::group(['prefix' => 'auth'], function() {
//    Route::group(['middleware' => 'auth:api'], function() {
//        Route::get('me', \App\App\Auth\Actions\MeAction::class)->name('me');
//        Route::post('logout', \App\App\Auth\Actions\UserLogoutAction::class)->name('logout');
//    });
//    Route::post('login', \App\App\Auth\Actions\UserLoginAction::class)->name('login');
//    Route::post('register', \App\App\Auth\Actions\UserRegisterAction::class)->name('register');
//});

Route::group(['middleware' => 'auth:api'], function() {
    Route::group(['prefix' => 'auth'], function () {
        Route::get('me', \App\App\Auth\Actions\MeAction::class)->name('me');
        Route::post('logout', \App\App\Auth\Actions\UserLogoutAction::class)->name('logout');
    });

//    Route::post('ads/{advertisement}/offer', )
});


Route::post('login', \App\App\Auth\Actions\UserLoginAction::class)->name('login');
Route::post('register', \App\App\Auth\Actions\UserRegisterAction::class)->name('register');
