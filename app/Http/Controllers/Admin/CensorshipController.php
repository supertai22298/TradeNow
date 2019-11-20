<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassExecuteRequest;
use App\Http\Requests\NotCensoredRequest;
use App\Models\Product;

class CensorshipController extends Controller
{
  public const WAIT_FOR_CENSORSHIP = 0;
  public const IS_CENSORED = 1;
  public const NOT_CENSORED = 2;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $productsAll = Product::orderBy('created_at','desc')->paginate(5);
      $productsWaitCensored = Product::where('is_checked','=','0')->orderBy('created_at','desc')->paginate(5);
      $productsCensored = Product::where('is_checked','=','1')->orderBy('created_at','desc')->paginate(5);
      $productsNotCensored = Product::where('is_checked','=','2')->orderBy('created_at','desc')->paginate(5);
      $products = [
        'productsAll' => $productsAll,
        'productsWaitCensored' => $productsWaitCensored,
        'productsCensored' => $productsCensored,
        'productsNotCensored' => $productsNotCensored,
      ];
      return view('admins.censorships.index',compact('products'));
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Product $censorship)
  {
      // $product = Product::find($id);
      return view('admins.censorships.show', compact('censorship'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Product $censorship)
  {
      $censorship->delete();
      return back()->with('success', 'Thao tác thành công');
  }
  public function censored(Product $product)
  {
      //is_checked = 1
      $product->is_checked = self::IS_CENSORED;
      $product->save();
      return back()->with('success', 'Thao tác thành công');
  }
  public function massCensored(Request $request)
  {
      // xác nhận hàng loạt
      $products = Product::whereIn('id', request('ids'))->get();
      foreach ($products as $product) {
          $product->is_checked = self::IS_CENSORED;
          $product->save();
      }
      return back()->with('success', 'Thao tác thành công');
  }
  public function notCensored(NotCensoredRequest $request)
  {
      //is_checked = 2
      $product = Product::find($request->id);
      $product->is_checked = self::NOT_CENSORED;
      $product->violation = $request->violation;
      $product->save();
      return back()->with('success', 'Thao tác thành công');
  }
  public function massNotcensored(Request $request)
  {
      // không xác nhận hàng loạt
      $products = Product::whereIn('id', request('ids'))->get();
      foreach ($products as $product) {
          $product->is_checked = self::NOT_CENSORED;
          $product->violation = "Thực hiện tự hàn loạt";
          $product->save();
      }
      return back()->with('success', 'Thao tác thành công');
  }

  public function massExecute(MassExecuteRequest $request)
  {
    if($request->btnBan == 'ban'){
      return $this->massNotcensored($request);
    }
    elseif($request->btnCensorship == 'censorship'){
      return $this->massCensored($request);
    }
  }
}
