<?php

Route::get('/', function () {
    return view('main');
})->middleware(['auth', 'check.delete']);

Auth::routes();

Route::post('/verify', 'InvitationController@verify')->name('verify');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/edit/profile', 'AuthUserController@showProfileForm')->name('edit/profile');
Route::post('edit/profile', 'AuthUserController@updateProfile');
Route::post('edit/profile/{id}', 'AuthUserController@destroy')->name('delete-myself');

Route::get('/edit/password', 'AuthUserController@showPasswordForm')->name('edit/password');
Route::post('edit/password', 'AuthUserController@updatePassword');


Route::get('/invitation-key', 'InvitationController@showInvitationKeyForm')->name('invitation-key');
Route::post('/create-key', 'InvitationController@createKey')->name('create-key');

Route::resource('users', 'UsersManagementSystemController');

