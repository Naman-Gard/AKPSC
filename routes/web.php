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

Route::group(["middleware" => ["islogout"]], function(){
    Route::get('/', function () {
        return view('auth/login');
    })->name('/');
    
    Route::post('register', 'App\Http\Controllers\AuthController@register')->name('register');
    Route::post('login', 'App\Http\Controllers\AuthController@login')->name('login');
});

Route::group(["middleware" => ["islogin"]], function(){
    Route::get('/fill-details', 'App\Http\Controllers\FormController@index')->name('fill-details');
    Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
    Route::post('submit', 'App\Http\Controllers\FormController@submit')->name('submit');
    Route::post('education', 'App\Http\Controllers\FormController@education')->name('education');
    Route::get('final-save/education', 'App\Http\Controllers\FormController@finalEducation')->name('final-education');
    Route::post('experience', 'App\Http\Controllers\FormController@experience')->name('experience');
    Route::post('preference', 'App\Http\Controllers\FormController@preference')->name('preference');
});