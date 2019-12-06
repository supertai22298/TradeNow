<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ChangePasswordRequest;
use App\Http\Requests\Client\UpdateUserRequest;
use App\Models\User;
use App\Services\UploadImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function profile(){
    return view('clients.user.profile');
  }

  public function update(UpdateUserRequest $request){
    if(Auth::check()){
      $user = User::find(Auth::user()->id);

      $arrUpdate = $request->all();
      // update
      if($request->hasFile('avatar')) {
        $imagePath = UploadImageService::uploadImage($request->file('avatar'));
        $thumbnailPath = UploadImageService::resizeImage($imagePath, 400, 400);
        $arrUpdate['avatar'] = basename($thumbnailPath);
      }
      $user->update($arrUpdate);

      return response()->json([
        'success' => 'Chỉnh sửa thành công',
        'data' => $user,
      ], 200, []);
      } else {
        return redirect('/login')->with('msg', 'Hãy đăng nhập để dùng tính năng này');
    }
  }

  public function changePassword(ChangePasswordRequest $request){
    if(Auth::check()){
      $user = User::find(Auth::user()->id);
      if (Hash::check($request->old_password, $user->password)) {
          $user->password = bcrypt($request->new_password);
          $user->save();
          return response()->json([
            'success' => 'Đổi mật khẩu thành công',
          ], 200, []);
      } else {
          return response()->json([
            'failed' => 'Vui lòng nhập chính xác mật khẩu',
          ], 200, []);
      }
      } else {
        return redirect('/login')->with('msg', 'Hãy đăng nhập để dùng tính năng này');
    }
  }

  public function order(){
    $cost = 0;
    //all
    $orders = DB::table('orders')->join('order_product','order_product.order_id','=','orders.id')
    ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
    ->join('products','order_product.product_id','=','products.id')
    ->where('orders.user_id','=',1)
    ->select('orders.*','order_product.quantity','order_product.description','products.name','products.price','products.thumbnail','order_statuses.name AS status')
    ->get()->toArray();
    // delivered
    $orders_delivered = DB::table('orders')->join('order_product','order_product.order_id','=','orders.id')
    ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
    ->join('products','order_product.product_id','=','products.id')
    ->where('orders.user_id','=',1)
    ->where('order_statuses.name','=','Đã giao')
    ->select('orders.*','order_product.quantity','order_product.description','products.name','products.price','products.thumbnail','order_statuses.name AS status')
    ->get()->toArray();
    // delivering
    $orders_delivering = DB::table('orders')->join('order_product','order_product.order_id','=','orders.id')
    ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
    ->join('products','order_product.product_id','=','products.id')
    ->where('orders.user_id','=',1)
    ->where('order_statuses.name','=','Đang giao')
    ->select('orders.*','order_product.quantity','order_product.description','products.name','products.price','products.thumbnail','order_statuses.name AS status')
    ->get()->toArray();
    // canceled
    $orders_canceled = DB::table('orders')->join('order_product','order_product.order_id','=','orders.id')
    ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
    ->join('products','order_product.product_id','=','products.id')
    ->where('orders.user_id','=',1)
    ->where('order_statuses.name','=','Đã hủy')
    ->select('orders.*','order_product.quantity','order_product.description','products.name','products.price','products.thumbnail','order_statuses.name AS status')
    ->get()->toArray();

    return view('clients.user.order_management',compact('orders','orders_delivered','orders_delivering','orders_canceled','cost'));
  }
}
