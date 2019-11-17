<?php
Route::put('contacts/changeStar', 'ContactController@changeStar')->name('contacts.changeStar');
Route::get('contacts/star', 'ContactController@star')->name('contacts.star');

Route::get('contacts/compose', 'ContactController@compose')->name('contacts.compose');
Route::post('contacts/sendMail', 'ContactController@sendMail')->name('contacts.sendMail');

Route::get('contacts/{contact}/forward', 'ContactController@forward')->name('contacts.forward');
Route::get('contacts/{contact}/reply', 'ContactController@reply')->name('contacts.reply');

Route::delete('contacts/destroy', 'ContactController@massDestroy')->name('contacts.massDestroy');
Route::resource('contacts', 'ContactController');