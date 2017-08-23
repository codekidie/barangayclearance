<?php

use Illuminate\Http\Request;
use App\Blotter;

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


Route::get('/admin/users', function (Request $request) {
	 $users = DB::table('users')->get();
	 return $users;
});

Route::get('/admin/officials', function (Request $request) {
	 $users = DB::table('users')
	 		 ->where('role', '=', 'Purok leader')
            ->orderBy('id', 'desc')	
	 		->get();
	 return $users;
});


Route::prefix('/admin/')->group(function () {
		Route::post('/blotter/sendnotice', 'Admin\StaffController@sendBlotterNotice')->name('sendBlotterNotice');
		Route::get('/blotter/notice/{id}', 'Admin\StaffController@notice')->name('noticeBlotterStaff');
		Route::get('/blotter/notice/delete/{id}', 'Admin\StaffController@delete_notice')->name('delete_notice');
		Route::get('/blotter/notice/edit/{id}', 'Admin\StaffController@edit_notice')->name('edit_notice');
		Route::post('/blotter/notice/save', 'Admin\StaffController@save_notice')->name('save_notice');

		Route::get('/purokleader/delete/{id}', 'Admin\StaffController@delete_purokleader')->name('delete_purokleader');
		Route::post('/purokleader/save', 'Admin\StaffController@save_purokleader')->name('save_purokleader');
		Route::get('/purokleaders', 'Admin\StaffController@purokleaders')->name('purokleaders');


});	


// Residents API

Route::get('/resident/fullname'              , 'BlotterController@blotterFullname')->name('blotterFullname');
Route::get('/resident/blotter'              , 'BlotterController@getAllBlotter')->name('getAllBlotter');

Route::get('/resident/blotter/view/{id}'              , 'BlotterController@getAllBlotterViewModal')->name('getAllBlotterViewModal');

Route::get('/resident/blotter/{id}'              , 'BlotterController@getBlotterByUserId')->name('getBlotterByUserId');
Route::get('/resident/blotter/edit/{id}'         , 'BlotterController@edit')->name('getBlotterByUserId');
Route::get('/resident/blotter/delete/{id}'       , 'BlotterController@delete')->name('blotter_delete');
Route::post('/resident/blotter/save'             , 'BlotterController@save')->name('postBlottersave');
Route::post('/resident/blotter/save_edit'   , 'BlotterController@save_edit')->name('postBlotterEdit');
Route::get('/resident/blotter/notice/{id}'   , 'BlotterController@notice')->name('noticeBlotter');
Route::get('/resident/blotternoticecount/{id}'   , 'BlotterController@blotternoticecount')->name('noticeBlotter');
Route::get('/resident/blotter/notice/isviewed/{id}'   , 'BlotterController@update_viewed')->name('isviewed');
Route::get('/resident/profile/latlong/{lat}/{long}/{id}'   , 'ResidentController@update_userLatLong')->name('update_userLatLong');
Route::get('/resident/profiles'   , 'ResidentController@profiles_pic')->name('profiles_pic');









