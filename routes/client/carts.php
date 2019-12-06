<?php

Route::group(['as' => 'cart.'], function () {

  Route::get('carts/view', function () {
    return view('clients.carts.view');
  })->name('view');
  Route::get('carts/checkout', function () {
    return view('clients.carts.checkout');
  })->name('checkout');
});
