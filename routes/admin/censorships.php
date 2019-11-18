<?php
 Route::put('censorships/massExecute', 'CensorshipController@massExecute')->name('censorships.massExecute');
 Route::put('censorships/{product}/censored', 'CensorshipController@censored')->name('censorships.censored');
 Route::put('censorships/notCensored', 'CensorshipController@notCensored')->name('censorships.notCensored');
 Route::resource('censorships', 'CensorshipController');