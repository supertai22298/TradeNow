<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "name","description","price",
    ];

    // one - many relationship between category -> product (reverse) 
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function product_status()
    {
        return $this->belongsTo('App\Models\ProductStatus');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function product_details()
    {
        return $this->hasMany('App\Models\ProductDetail');
    }

    public function diffFromNow() {
        Carbon::setLocale('vi');
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        
        if($this->created_at !=null){
            $date = $this->created_at ?  Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at, 'Asia/Ho_Chi_Minh'): $now;
            return $date->diffForHumans($now);
        }else {
            return "Không xác định";
        }
    }
}
