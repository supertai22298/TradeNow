<?php
Route::put('contacts/changeStar', 'ContactController@changeStar')->name('contacts.changeStar');
Route::get('contacts/star', 'ContactController@star')->name('contacts.star');
Route::delete('contacts/destroy', 'ContactController@massDestroy')->name('contacts.massDestroy');
Route::resource('contacts', 'ContactController');