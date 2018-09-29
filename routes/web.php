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
use \Illuminate\Http\Request;

Route::get('/', function () {
    return view('main');
})->middleware(['auth', 'check.delete']);

Route::post('/verify', function (Request $request) {
    session(['invitation-key' => $request['invitation-key']]);
    return redirect('register');
})->name('verify');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/edit/profile', 'EditController@showProfileForm')->name('edit/profile');
Route::post('edit/profile', 'EditController@updateProfile');
Route::post('edit/profile/{id}', 'EditController@destroy')->name('delete-myself');

Route::get('/edit/password', 'EditController@showPasswordForm')->name('edit/password');
Route::post('edit/password', 'EditController@updatePassword')->name('edit/password');


Route::get('/invitation-key', 'InvitationController@showInvitationKeyForm')->name('invitation-key');
Route::post('/invitation-key', 'InvitationController@createKey')->name('invitation-key');



Route::resource('users', 'UserController');

