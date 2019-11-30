<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeStatusOrderRequest;
use App\Http\Requests\MassDestroyOrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $queryTakeOrder = DB::table('orders')
        ->join('order_product', 'orders.id', '=', 'order_product.order_id')
        ->join('products', 'products.id', '=', 'order_product.product_id')
        ->join('users', 'users.id', '=', 'products.user_id')
        ->where('products.user_id', '=', $user->id)
        ->select('orders.id')
        ->get()->toArray();
        $orderId = [];
        foreach ($queryTakeOrder as $key => $value) {
            array_push($orderId, $value->id);
        }
        
        $orders = Order::whereIn('id', $orderId)->get();
        return view('admins.orders.index', compact('orders'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $statuses = OrderStatus::
            where('priority', '>=', $order->order_status->priority)
            ->orderBy('priority')
            ->get();
        return view('admins.orders.show', compact('order', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Xoá thành công');
    }

    public function massDestroy(MassDestroyOrderRequest $request) {
        Order::whereIn('id', $request->ids)->delete();
        return back()->with('success', 'Xoá thành công');
    }
    public function changeStatus(Order $order, ChangeStatusOrderRequest $request) {
      $order->update([
        'order_status_id' => $request->status
      ]);
      return back()->with('success', 'Thay đổi thành công');
    }
}
