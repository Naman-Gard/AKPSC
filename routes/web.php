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

Route::get('cache-clear',function(){
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    echo 'clear';
});


Route::group(["middleware" => ["islogout"]], function(){
    Route::get('/', function () {
        return view('auth/login');
    })->name('/');

    Route::get('check/isEmailRegistered/{data}', 'App\Http\Controllers\AuthController@isEmailRegistered');
    Route::post('send/otp', 'App\Http\Controllers\AuthController@sendOtp');
    Route::post('register', 'App\Http\Controllers\AuthController@register')->name('register');
    Route::post('login', 'App\Http\Controllers\AuthController@login')->name('login');
    Route::post('send/reset/link/{email}', 'App\Http\Controllers\AuthController@sendResetLink');
    Route::get('/token={email}/{date}/{time}', 'App\Http\Controllers\AuthController@viewReset')->name('view-reset');
    Route::post('/succeed/{email}/{date}/{time}', 'App\Http\Controllers\AuthController@successful')->name('succeed');
});

Route::group(["middleware" => ["islogin"]], function(){
    Route::get('fill-details', 'App\Http\Controllers\FormController@index')->name('fill-details');
    Route::get('preview', 'App\Http\Controllers\FormController@preview')->name('preview');
    Route::get('edit/Form', 'App\Http\Controllers\FormController@editForm');
    Route::get('final/submit', 'App\Http\Controllers\FormController@finalSubmit');
    Route::get('form-view', 'App\Http\Controllers\FormController@finalView')->name('form-view');
    Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
    Route::post('submit', 'App\Http\Controllers\FormController@submit')->name('submit');
    Route::get('generate-pdf', 'App\Http\Controllers\FormController@generatePDF')->name('generate-pdf');

    //Profile Route//
    Route::get('profile', 'App\Http\Controllers\ProfileController@index')->name('profile');

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
    Route::get('getStates', 'App\Http\Controllers\FormController@getStates');

});


// Admin Panel Routes
Route::group(["middleware" => ["adminlogout"]], function(){

    Route::get('secureadmin', function () {
        return view('admin/auth/login');
    })->name('secure-admin');

    Route::post('secureadmin/login', 'App\Http\Controllers\AdminController@login')->name('admin-login');
    Route::post('secureadmin/check/credentials', 'App\Http\Controllers\AdminController@checkCredentials')->name('admin-credentials');
    // Route::get('secureadmin/send/otp/{mobile}/{OTP}', 'App\Http\Controllers\AdminController@sendOTP')->name('admin-sendOTP');

});

Route::group(["middleware" => ["adminlogin"]], function(){
    Route::get('secureadmin/dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('dashboard');
    Route::get('secureadmin/getSubjects', 'App\Http\Controllers\AdminController@getSubjects');
    Route::get('secureadmin/getStates', 'App\Http\Controllers\AdminController@getStates');
    Route::get('secureadmin/profile', 'App\Http\Controllers\AdminController@profile')->name('admin-profile');
    Route::post('secureadmin/change-password', 'App\Http\Controllers\AdminController@changePassword')->name('change-password');
    Route::get('secureadmin/getUsers', 'App\Http\Controllers\AdminController@getUsers')->name('getUsers');
    Route::get('secureadmin/getReportUsers', 'App\Http\Controllers\AdminController@getReportUsers')->name('getReportUsers');
    Route::get('secureadmin/logout', 'App\Http\Controllers\AdminController@logout')->name('admin-logout');
    Route::post('secureadmin/add/empanel', 'App\Http\Controllers\EmpanelController@addEmpanel')->name('add-empanel');
    Route::post('secureadmin/blacklisted', 'App\Http\Controllers\BlackListController@index')->name('blacklisted');
    Route::get('remove/blacklistedUser/{id}', 'App\Http\Controllers\BlackListController@removeUser')->name('remove-blacklistedUser');
    Route::post('secureadmin/appointed', 'App\Http\Controllers\AppointController@index')->name('appointed');

    Route::get('secureadmin/registered/users', 'App\Http\Controllers\AdminController@getRegisteredUser')->name('registered-users');
    Route::get('secureadmin/empanelled/users', 'App\Http\Controllers\AdminController@getEmpanelledUser')->name('empanelled-users');
    Route::get('secureadmin/blacklisted/users', 'App\Http\Controllers\AdminController@getBlacklistedUser')->name('blacklisted-users');
    Route::get('secureadmin/appointed/users', 'App\Http\Controllers\AppointController@getUsers')->name('appointed-users');
    Route::get('secureadmin/qualification', 'App\Http\Controllers\ManageMasters@getQualification')->name('qualification');
    Route::post('secureadmin/addDegreeType', 'App\Http\Controllers\ManageMasters@addDegreeType')->name('addDegreeType');
    Route::post('secureadmin/addDegreeName', 'App\Http\Controllers\ManageMasters@addDegreeName')->name('addDegreeName');
    Route::post('secureadmin/addSubject', 'App\Http\Controllers\ManageMasters@addSubject')->name('addSubject');
    Route::get('secureadmin/deleteQualification/{id}', 'App\Http\Controllers\ManageMasters@deleteQualification')->name('deleteQualification');
    Route::get('secureadmin/getQualificationsubject', 'App\Http\Controllers\ManageMasters@getQualificationsubject')->name('getQualificationsubject');
    Route::get('secureadmin/report', 'App\Http\Controllers\AdminController@getReport')->name('report');
});

Route::group(["middleware" => ["superadminlogout"]], function(){

    Route::get('coeadmin', function () {
        return view('super-admin/auth/login');
    })->name('secure-superadmin');

    Route::post('coeadmin/login', 'App\Http\Controllers\SuperAdminController@login')->name('superadmin-login');
    Route::post('coeadmin/check/credentials', 'App\Http\Controllers\SuperAdminController@checkCredentials')->name('superadmin-credentials');
    // Route::get('coeadmin/send/otp/{mobile}/{OTP}', 'App\Http\Controllers\SuperAdminController@sendOTP')->name('superadmin-sendOTP');

});

Route::group(["middleware" => ["superadminlogin"]], function(){
    Route::get('coeadmin/dashboard', 'App\Http\Controllers\SuperAdminController@dashboard')->name('superadmin-dashboard');
    Route::get('coeadmin/profile', 'App\Http\Controllers\SuperAdminController@profile')->name('superadmin-profile');
    Route::post('coeadmin/update-profile', 'App\Http\Controllers\SuperAdminController@updateProfile')->name('update-superadmin');
    Route::get('coeadmin/logout', 'App\Http\Controllers\SuperAdminController@logout')->name('superadmin-logout');
    Route::post('coeadmin/add-section', 'App\Http\Controllers\SuperAdminController@addSection')->name('add-section');
    Route::get('coeadmin/edit-section/{id}', 'App\Http\Controllers\SuperAdminController@editSection')->name('edit-section');
    Route::post('coeadmin/save-section', 'App\Http\Controllers\SuperAdminController@saveSection')->name('save-section');
    Route::get('coeadmin/remove-section/{id}', 'App\Http\Controllers\SuperAdminController@removeSection')->name('remove-section');
    Route::get('coeadmin/check/isEmailRegistered/{data}', 'App\Http\Controllers\SuperAdminController@isEmailRegistered');
});
