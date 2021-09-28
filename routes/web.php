<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard;
Route::get('/', function () {
    return view('welcome');
});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function(){
        Auth::routes();
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::group(['middleware' => ['auth']], function() {
           Route::resource('users',App\Http\Controllers\UserController::class);
           Route::resource('roles',App\Http\Controllers\RoleController::class);
           Route::resource('sections',Dashboard\SectionController::class);
           Route::resource('products',Dashboard\ProductController::class);
           Route::resource('clients',Dashboard\ClientController::class);
           Route::resource('clients\orders',Dashboard\OrderController::class);


        });
    });
