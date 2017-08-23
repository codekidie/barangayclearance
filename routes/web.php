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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/barangaylocation', function () {
    return view('guest/barangaylocation');
});

Route::get('/barangayofficials', function () {
	   $data['users'] = DB::table('users')
	    ->where('role', '=', 'Barangay Captain')
	    ->orderBy('id', 'desc')
	    ->get();

    return view('guest/barangayofficials',$data);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('/resident/')->group(function () {
		Route::get('/blotter', 'ResidentController@blotter')->name('blotter');
		Route::get('/businesspermit', 'ResidentController@businesspermit')->name('businesspermit');
		Route::get('/message', 'ResidentController@checkmessage')->name('checkmessage');
		Route::get('/clearance', 'ResidentController@clearance')->name('clearance');
		Route::get('/details', 'ResidentController@details')->name('details');
		Route::get('/location', 'ResidentController@location')->name('location');
		Route::get('/prerequisite', 'ResidentController@prerequisite')->name('prerequisite');
		Route::get('/certificate', 'ResidentController@requestcertificate')->name('requestcertificate');
		Route::get('/schedule', 'ResidentController@schedule')->name('schedule');
		Route::get('/socialpension', 'ResidentController@socialpension')->name('socialpension');
		Route::get('/profile', 'ResidentController@profile')->name('profile');
});

Route::prefix('/admin/')->group(function () {
		Route::get('/credentials', 'Admin\AdminController@credentials')->name('credentials');
		Route::get('/blotter', 'Admin\AdminController@blotter')->name('staff_blotter');
		Route::get('/announcement', 'Admin\AdminController@announcement')->name('announcement');
		Route::get('/receiveletter', 'Admin\AdminController@receiveletter')->name('receiveletter');
		Route::get('/setappointment', 'Admin\AdminController@setappointment')->name('setappointment');
		Route::get('/purokleaderlocation', 'Admin\AdminController@purokLeaderLocation')->name('purokLeaderLocation');
		Route::get('/listusers', 'Admin\StaffController@listusers')->name('listusers');
		Route::get('/user/{username}', 'Admin\AdminController@profile')->name('profile');
		
});



Route::post('/upload', 'Admin\AdminController@uploadSubmit');
Route::post('/editprofile', 'Admin\AdminController@editprofile');


