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
    $categories = Category::has('products')->get();
    $brands = Brand::has('products')->get();
    $allProducts = Product::where([
      ['is_checked', Product::IS_CENSORED],
      ['active', Product::ACTIVE],
    ])->get()->count();

    $productHavingOrder = Product::has('orders')->get()->count();

    $productOrdered = DB::table('order_product')
    ->select('product_id', DB::raw('count(*) as "Số lượng order"'), DB::raw('sum(quantity) as "Tổng số lượng"'))
    ->groupBy('product_id')->get(12);
    // dd($productOrdered);

    return view('clients.homepage');
  }
}
