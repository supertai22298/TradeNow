<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductPromotion extends Model
{
    //
    protected $table = 'product_promotion';

    protected $fillable = [
        'promotion_id', 'product_id', 'amount'
    ];
    public static function getProductPromotion($user_id)
    {
        return DB::table('products')->select(
            DB::raw("products.id"),
            DB::raw("products.name"),
            DB::raw("products.description"),
            DB::raw("products.price"),
            DB::raw("products.amount"),
            DB::raw("products.image"),
            DB::raw("products.is_checked"),
            DB::raw("product_promotion.amount"),
            DB::raw("product_promotion.product_id"),
            DB::raw("product_promotion.promotion_id"),
            DB::raw("promotions.type"),
            DB::raw("promotions.reduction_level")
        )
            ->join("product_promotion", 'products.id', '=', 'product_promotion.product_id')
            ->join("promotions", 'promotions.id', '=', 'product_promotion.promotion_id')
            ->groupBy('product_promotion.product_id', 'product_promotion.promotion_id')

            ->where('products.user_id', $user_id)
            ->where('products.is_checked', Product::IS_CENSORED)
            ->get();
    }
}
