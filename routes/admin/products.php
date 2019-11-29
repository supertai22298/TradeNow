<?php
 Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
 Route::put('comments/{comment}/replyComment', 'CommentController@replyComment')->name('comments.replyComment');

Route::resource('products', 'ProductController');