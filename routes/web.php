<?php

Auth::routes();
Route::get('/', function () {
    return redirect('reservation');
});
Route::post('/verify', 'InvitationController@verify')->name('verify');
Route::get('/edit/profile', 'AuthUserController@showProfileForm')->name('edit/profile');
Route::post('edit/profile', 'AuthUserController@updateProfile');
Route::post('edit/profile/{id}', 'AuthUserController@destroy')->name('delete-myself');
Route::get('/edit/password', 'AuthUserController@showPasswordForm')->name('edit/password');
Route::post('edit/password', 'AuthUserController@updatePassword');
Route::get('/invitation-key', 'InvitationController@showInvitationKeyForm')->name('invitation-key');
Route::post('/create-key', 'InvitationController@createKey')->name('create-key');

Route::get('/logs', 'ActivityLogController@index')->name('logs');
Route::get('/logs/{id}', 'ActivityLogController@showChanges')->name('log.changes');
Route::get('/logs/user/{id}', 'ActivityLogController@showChangesByUser')->name('log.changes.by.user');

Route::resources(
    [
        'users'       => 'UsersManagementSystemController',
        'platens'     => 'PlatenController',
        'reservation' => 'ReservationController',
    ]
);
Route::post('reservation/get-free-times', 'ReservationController@getFreeTimes')->name('reservation.get-free-times');
Route::post('reservation/show-all', 'ReservationController@showAll')->name('reservation.show-all');

Route::get('contacts', 'ContactController@show')->name('contacts.show');
Route::get('contacts/edit', 'ContactController@edit')->name('contacts.edit');
Route::put('contacts', 'ContactController@update')->name('contacts.update');

Route::get('scheme', 'PlatensSchemeController@show')->name('scheme.show');
Route::get('scheme/edit', 'PlatensSchemeController@edit')->name('scheme.edit');
Route::post('scheme', 'PlatensSchemeController@update')->name('scheme.update');


Route::get('reviews', 'ReviewController@index')->name('reviews.index');
Route::delete('reviews/{id}', 'ReviewController@destroy')->name('reviews.destroy');