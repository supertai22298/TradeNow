<?php

Route::get('categories/{category}', 'CategoryController@getProducts')->name('categories.show');