<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class WishList extends Model
{
  use SoftDeletes;
  // protected $table = "wish_lists";
  protected $fillable = [
    'product_id', 'user_id',
  ];
  public function user(){
    return $this->belongsTo(User::class);
 }

 public function product(){
    return $this->belongsTo(Product::class);
 }

  public static function getWishList(){
    $wish_lists = WishList::where('user_id','=',Auth::user()->id)->get();
    return count($wish_lists);
  }
}
