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

    Route::get('check/isEmailRegistered/{email}', 'App\Http\Controllers\AuthController@isEmailRegistered');
    Route::get('send/otp/{email}/{otp}', 'App\Http\Controllers\AuthController@sendOtp');
    Route::post('register', 'App\Http\Controllers\AuthController@register')->name('register');
    Route::post('login', 'App\Http\Controllers\AuthController@login')->name('login');
});

Route::group(["middleware" => ["islogin"]], function(){
    Route::get('fill-details', 'App\Http\Controllers\FormController@index')->name('fill-details');
    Route::get('preview', 'App\Http\Controllers\FormController@preview')->name('preview');
    Route::get('edit/Form', 'App\Http\Controllers\FormController@editForm');
    Route::get('final/submit', 'App\Http\Controllers\FormController@finalSubmit');
    Route::get('submitted', 'App\Http\Controllers\FormController@finalView');
    Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
    Route::post('submit', 'App\Http\Controllers\FormController@submit')->name('submit');

    //Education Routes//
    Route::post('add/specialization', 'App\Http\Controllers\EducationController@addSpecialization');
    Route::post('add/Education', 'App\Http\Controllers\EducationController@addEducation');
    Route::get('delete/Specialization/{id}', 'App\Http\Controllers\EducationController@deleteSpecialization');
    Route::get('delete/Education/{id}', 'App\Http\Controllers\EducationController@deleteEducation');
    Route::get('final-save/education', 'App\Http\Controllers\EducationController@finalEducation');
    Route::get('getSubjects', 'App\Http\Controllers\EducationController@getSubjects');
    Route::get('getQualifications', 'App\Http\Controllers\EducationController@getQualifications');

    //Get Form Data Routes
    Route::get('getExperienceData', 'App\Http\Controllers\FormController@getExperienceData');
    Route::get('getPreferenceData', 'App\Http\Controllers\FormController@getPreferenceData');
    Route::get('getFormData', 'App\Http\Controllers\FormController@getFormData');
    
    //Experience Routes
    Route::post('add/experience', 'App\Http\Controllers\ExperienceController@addExperience');
    Route::post('add/organization', 'App\Http\Controllers\ExperienceController@addOrganization');
    Route::post('add/finalExperience', 'App\Http\Controllers\ExperienceController@addFinalExperience');
    Route::get('delete/Experience/{id}', 'App\Http\Controllers\ExperienceController@deleteExperience');
    Route::get('delete/Organization/{id}', 'App\Http\Controllers\ExperienceController@deleteOrganization');

    //Preference & other Routes
    Route::post('add/LanguageDetails', 'App\Http\Controllers\PreferenceController@addLanguageDetails');
    Route::get('delete/Language/{id}', 'App\Http\Controllers\PreferenceController@deleteLanguage');
    Route::post('add/Preference', 'App\Http\Controllers\PreferenceController@addPreference');
});