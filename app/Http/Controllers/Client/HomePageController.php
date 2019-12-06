<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
  public function index(){
   
    $allProducts = Product::where([
      ['is_checked', Product::IS_CENSORED],
      ['active', Product::ACTIVE],
    ])->get()->count();

    $productHavingOrder = Product::has('orders')->get()->count();
    return view('clients.homepage');
  }
}
