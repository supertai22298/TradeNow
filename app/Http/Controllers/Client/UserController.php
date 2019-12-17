<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ChangePasswordRequest;
use App\Http\Requests\Client\UpdateUserRequest;
use App\Models\User;
use App\Models\WishList;
use App\Services\UploadImageService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function profile()
  {
    return view('clients.user.profile');
  }

  public function update(UpdateUserRequest $request)
  {
    if (Auth::check()) {
      $user = User::find(Auth::user()->id);

      $arrUpdate = $request->all();
      // update
      if ($request->hasFile('avatar')) {
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

  public function changePassword(ChangePasswordRequest $request)
  {
    if (Auth::check()) {
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

  public function order()
  {
    $cost = 0;
    //all
    $orders = $this->getOrder();
    // delivered
    $orders_delivered = $this->getOrder('order_statuses.name', 'Đã giao');
    // delivering
    $orders_delivering = $this->getOrder('order_statuses.name', 'Đang giao');
    // canceled
    $orders_canceled = $this->getOrder('order_statuses.name', 'Đã hủy');

    return view('clients.user.order_management', compact('orders', 'orders_delivered', 'orders_delivering', 'orders_canceled', 'cost'));
  }

  public function wishList()
  {
    $wish_lists = WishList::where('user_id', '=', Auth::user()->id)->simplePaginate(4);
    return view('clients.user.wish_list', compact('wish_lists'));
  }

  public function addWishList(Request $request)
  {
    $check_wish_list = DB::table('wish_lists')
      ->where([['product_id', '=', $request->id], ['user_id', '=', Auth::user()->id]])
      ->get();
    if (count($check_wish_list) > 0) {
      $check_wish_list = DB::table('wish_lists')
        ->where([['product_id', '=', $request->id], ['user_id', '=', Auth::user()->id]])
        ->update(['deleted_at' => null]);
    } else {
      $wish_list = WishList::create(['product_id' => $request->id, 'user_id' => Auth::user()->id]);
    }
    return response()->json(
      [
        "count" => WishList::getWishList(),
      ]
    );
  }
  public function removeToWishList(Request $request)
  {
    $wish_list = WishList::where([['product_id', '=', $request->id], ['user_id', '=', Auth::user()->id]]);
    $wish_list->delete();
    $wish_lists = WishList::where('user_id', '=', Auth::user()->id)->get();
    return $wish_lists;
  }


  public function getOrder($column = null, $status = null)
  {
    $orders = DB::table('orders')->join('order_product', 'order_product.order_id', '=', 'orders.id')
      ->join('order_statuses', 'orders.order_status_id', '=', 'order_statuses.id')
      ->join('products', 'order_product.product_id', '=', 'products.id')
      ->where('orders.user_id', '=', Auth::user()->id)
      ->where($column, '=', $status)
      ->select('orders.*', 'order_product.quantity', 'order_product.description', 'products.name', 'products.price', 'products.thumbnail', 'order_statuses.name AS status')
      ->get()->toArray();
    return $orders;
  }
}
