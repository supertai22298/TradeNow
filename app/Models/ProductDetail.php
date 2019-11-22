<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'type', 'description', 'product_id'
    ];
}
