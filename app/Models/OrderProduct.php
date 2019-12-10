<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';
    //
    protected $fillable = [
        'product_id', 'order_id', 'quantity', 'price', 'description'
    ];
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function getSubTotal() {
        $total = 0;
        $total = $this->quantity * $this->product->price;
        return number_format($total, 0, ',', '.');
    }
}
