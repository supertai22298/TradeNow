<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductPromotionRequest;
use App\Http\Requests\StoreProductPromotionRequest;
use App\Models\Product;
use App\Models\ProductPromotion;
use App\Models\Promotion;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductPromotion::getProductPromotion(Auth::user()->id)->toArray();
        // dd($products);
        return view('admins.product_promotions.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotions = Promotion::all();

        $promotions = $promotions->filter(function ($item) {
            $finished_at = Carbon::createFromFormat('Y-m-d H:i:s', $item->finished_at)->timestamp;
            return $finished_at > Carbon::now()->timestamp;
        });
        $products = Product::where([
            ['user_id', Auth::user()->id],
            ['active', 1],
            ['is_checked', Product::IS_CENSORED]
        ])->get();
        return view('admins.product_promotions.create', compact('promotions', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductPromotionRequest $request)
    {
        try {
            ProductPromotion::create([
                'promotion_id' => $request->promotion_id,
                'product_id' => $request->product_id,
                'product_id' => $request->product_id,
                'amount' => $request->amount,
            ]);
        } catch (Exception $ex) {
            return back()->with('primary', 'Đã tồn tại sản phẩm trong chương trình này');
        }
        return back()->with('success', 'Thêm thành công');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductPromotion  $productPromotion
     * @return \Illuminate\Http\Response
     */
    public function show(ProductPromotion $productPromotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductPromotion  $productPromotion
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductPromotion $productPromotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductPromotion  $productPromotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductPromotion $productPromotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductPromotion  $productPromotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $product_id, $promotion_id)
    {
        ProductPromotion::where([
            'product_id' => $product_id,
            'promotion_id' => $promotion_id,
        ])->delete();
        return back()->with('success', 'Xoá thành công');
    }
    public function massDestroy(MassDestroyProductPromotionRequest $request)
    {
        foreach ($request->ids as $item) {
            $arr = explode('-', $item);
            $product_id = $arr[0];
            $promotion_id = $arr[1];

            ProductPromotion::where([
                'product_id' => $product_id,
                'promotion_id' => $promotion_id,
            ])->delete();
        }
        return back()->with('success', 'Xoá thành công');
    }
}
