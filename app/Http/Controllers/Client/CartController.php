<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\HandleCheckOutCartRequest;
use App\Models\Product;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    //
    public function view() {
        return view('clients.carts.view');
    }
    public function checkout() {
        return view('clients.carts.checkout');
    }

    public function handleCheckout(HandleCheckOutCartRequest $rq) {
        $cart = json_decode($rq->contents, true);//nhận vào contents của CART
        $ids = Arr::pluck($cart, 'id'); // chỉ lấy id sản phẩm
        $products = Product::select('id', 'user_id', 'name')->whereIn('id', $ids)->get();//lấy id, id của nhà cung cấp
        $supliers = Product::select('user_id')->whereIn('id', $ids)->groupBy('user_id')->get();//tìm những id không trùng của nhà cung cấp

        $filter = [];
        //$filter là 1 mảng có key là id của nhà cung cấp
        // lọc ra những sản phẩm thuộc nào có cùng nhà cung cấp
        foreach($supliers as $obj) {
           $filter[$obj->user_id] = $products->filter(function($item) use ($obj) {
               return $obj->user_id == $item->user_id;
           });
        }
        //chuyển mỗi sản phẩm từ 1 eloquent collection sang 1 array
        $filter = array_map(function($item){
            return $item->toArray();
        }, $filter);
        
        // map những sản phẩm từ cart vào filter để dùng cho việc lưu vào bảng order và order_product
        // những sản phẩm có cùng 1 nhà cung cấp sẽ lưu vào 1 order
        $filter = array_map(function($item) use ($cart){
            $item = array_map(function($product) use ($cart) {
                foreach ($cart as $cartItem) {
                    if($product['id'] == $cartItem['id']) $product = $cartItem;
                }
                return $product;
            }, $item);
            return $item;
        }, $filter);

        dd($filter);
    }
}
