<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\HandleCheckOutCartRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function view()
    {
        return view('clients.carts.view');
    }
    public function checkout()
    {
        return view('clients.carts.checkout');
    }

    public function handleCheckout(HandleCheckOutCartRequest $rq)
    {
        $cart = json_decode($rq->contents, true); //nhận vào contents của CART
        if (count($cart) < 1) return back()->with('error', 'Không có sản phẩm nào được chọn');
        $ids = Arr::pluck($cart, 'id'); // chỉ lấy id sản phẩm
        $products = Product::select('id', 'user_id', 'name')->whereIn('id', $ids)->get(); //lấy id, id của nhà cung cấp
        $supliers = Product::select('user_id')->whereIn('id', $ids)->groupBy('user_id')->get(); //tìm những id không trùng của nhà cung cấp

        for ($i = 0; $i < count($cart); $i++) {
            unset($cart[$i]['image']);
        }
        $filter = [];
        //$filter là 1 mảng có key là id của nhà cung cấp
        // lọc ra những sản phẩm thuộc nào có cùng nhà cung cấp
        foreach ($supliers as $obj) {
            $filter[$obj->user_id] = $products->filter(function ($item) use ($obj) {
                return $obj->user_id == $item->user_id;
            });
        }
        //chuyển mỗi sản phẩm từ 1 eloquent collection sang 1 array
        $filter = array_map(function ($item) {
            return $item->toArray();
        }, $filter);

        // map những sản phẩm từ cart vào filter để dùng cho việc lưu vào bảng order và order_product
        // những sản phẩm có cùng 1 nhà cung cấp sẽ lưu vào 1 order
        $filter = array_map(function ($item) use ($cart) {
            $item = array_map(function ($product) use ($cart) {
                foreach ($cart as $cartItem) {
                    if ($product['id'] == $cartItem['id']) $product = $cartItem;
                }
                return $product;
            }, $item);
            return $item;
        }, $filter);

        // dd($rq->all());

        $order_status_id = OrderStatus::getIdOrderSuccessful();
        $user_id = Auth::check() ? Auth::user()->id : 1;
        foreach ($filter as $item) {
            $order = Order::create([
                'receive_name' => $rq->receive_name,
                'receive_phone' => $rq->receive_phone,
                'receive_city' => $rq->receive_city,
                'receive_address' => $rq->receive_address,
                'description' => $rq->description,
                'order_status_id' => $order_status_id,
                'user_id' => $user_id
            ]);
            foreach ($item as $product) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['qty'],
                    'price' => $product['itemPrice'],
                ]);
            }
        }
        //đã thêm thành công, có thể chuyển sang trang thankyou
        return redirect()->route('client.index')
            ->with('success', 'Thanh toán thành công');
    }
}
