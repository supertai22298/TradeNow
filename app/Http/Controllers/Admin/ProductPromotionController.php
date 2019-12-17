<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPromotion;
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
        $products = Product::has('promotions')->where([
            ['user_id', Auth::user()->id],
            ['is_checked', Product::IS_CENSORED],
        ])->get();

        
        $productsJoin = ProductPromotion::getProductPromotion(Auth::user()->id);
        dd($productsJoin);
        return view('admins.product_promotions.index', compact('products'));
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
    public function destroy(ProductPromotion $productPromotion)
    {
        //
    }
}
