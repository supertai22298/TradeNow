<?php

namespace App\Models;

use App\Http\Traits\DiffFromNow;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
  use SoftDeletes, DiffFromNow;

  public const WAIT_FOR_CENSORSHIP = 0;
  public const IS_CENSORED = 1;
  public const NOT_CENSORED = 2;
  public const ACTIVE = 1;
  public const INACTIVE = 0;
  protected $fillable = [
    'category_id',
    'brand_id',
    'user_id',
    'product_status_id',
    'name',
    'is_checked',
    'violation',
    'description',
    'price',
    'amount',
    'title_seo',
    'description_seo',
    'active',
    'image',
    'thumbnail'
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

  public function product_images()
  {
    return $this->hasMany('App\Models\ProductImage');
  }
  public function product_promotions()
  {
    return $this->hasMany('App\Models\ProductPromotion');
  }
  public function promotions()
  {
    return $this->belongsToMany('App\Models\Promotion');
  }

  public function product_details()
  {
    return $this->hasMany('App\Models\ProductDetail');
  }

  public function comments()
  {
    return $this->hasMany('App\Models\Comment');
  }

  public function reviews()
  {
    return $this->hasMany('App\Models\Review');
  }

  public function orders()
  {
    return $this->belongsToMany('App\Models\Order');
  }

  /**
   * Đếm số lượng record có trong bảng
   * @param integer $check = 0, 
   * @return Integer
   */
  public static function getNumberOfRow($checked = 0)
  {
    $conditions = [];
    if ($checked === self::IS_CENSORED) array_push($conditions, ['is_checked', self::IS_CENSORED]);
    return self::where($conditions)->get()->count();
  }

  /**
   * Trả về những sản phẩm theo trạng thái kiểm duyệt
   * @param integer $censorship = null (lấy theo const của class Product)
   * @return Collection $paginate(5)
   */
  public static function getProductByCensorship($censorship = null)
  {
    $conditions = [];
    if ($censorship === self::IS_CENSORED || $censorship === self::WAIT_FOR_CENSORSHIP || $censorship === self::NOT_CENSORED)
      array_push($conditions, ['is_checked', $censorship]);
    return self::where($conditions)->latest()->paginate(5);
  }

  /**
   * Giới hạn kí tự của mô tả sản phẩm
   * @return String
   */
  public function limitDescription($default = 50)
  {
    return \str_limit($this->description, $default, '...');
  }

  /**
   * Trả về format của giá theo chuẩn việt nam đồng
   * @return String
   */
  public function getFreshPrice()
  {
    return 'đ ' . number_format($this->price, 0, '', '.');
  }

  public function formatMoney($price)
  {
    return 'đ ' . number_format($price, 0, '', '.');
  }


  public function getPriceAfterReduce()
  {
    if ($this->has('promotions')) {
      $reduction_level = intval($this->promotions[0]->reduction_level);
      return $reduction_level < 100 ?
        $this->price * (1 - $reduction_level / 100) :
        $this->price - $reduction_level;
    }
    return  $this->price;
  }

  /**
   * Trả về class bootstrap theo số lượng
   * Lớn hơn 30 là xanh, lớn hơn 10 là vàng
   * còn lại là đỏ
   * @return String
   */
  public function changeTextAmountColor()
  {
    $amount = $this->amount;
    return $amount > 30 ? 'success' : ($amount > 10 ? 'warning' : 'danger');
  }

  /**
   * Lấy tên của trạng thái kiểm duyệt
   * @return String 
   */
  public function getTextOfCheck()
  {
    $check = $this->is_checked;
    return $check === self::WAIT_FOR_CENSORSHIP ? 'Đang chờ kiểm duyệt' : ($check === self::IS_CENSORED ? 'Đã kiểm duyệt' : 'Không được duyệt');
  }
  /**
   * Lấy màu theo trạng thái kiểm duyệt
   * @return String
   */
  public function getColorOfCheck()
  {
    $check = $this->is_checked;
    return $check === self::WAIT_FOR_CENSORSHIP ? 'warning' : ($check === self::IS_CENSORED ? 'success' : 'danger');
  }

  /**
   * Kiểm trả sản phẩm đã được kiểm duyệt
   * @return Boolean
   */
  public function isChecked()
  {
    return $this->is_checked === self::IS_CENSORED;
  }

  public function getIconOfCheck()
  {
    $check = $this->is_checked;
    return $check === self::WAIT_FOR_CENSORSHIP ? 'fa fa-file-import' : ($check === self::IS_CENSORED ? 'fa fa-check' : 'fa fa-ban');
  }

  public static function getBestSaleProducts()
  {
    $arrBestSaleProductId = DB::table('order_product')
      ->select('product_id', DB::raw('count(*) as order_count'), DB::raw('sum(quantity) as total_amount'))
      ->groupBy('product_id')
      ->orderBy('total_amount', 'desc')
      ->get(8)
      ->pluck('product_id');
    return self::whereIn('id', $arrBestSaleProductId)->get();
  }

  public function getFirstImage()
  {
    return $this->product_images->count() > 0 ? $this->product_images->first()->image : 'default.png';
  }
  public function getFirstThumbnail()
  {
    return $this->product_images->count() > 0 ? $this->product_images->first()->thumbnail : 'default.png';
  }

  public function hasWishList()
  {
    if(Auth::check()){
      $wisht_list = WishList::where([['product_id', '=', $this->id],['user_id', '=', Auth::user()->id]])->get();
      if (count($wisht_list) > 0) {
        return 'removeToWishList';
      }
      return 'addToWishList';
    }
    return "";
  }

  public function getRelatedProducts($category_id){
    return $relatedProducts = Product::where('category_id', '=', $category_id)->take(4)->get();
  }

  public function getHtmlRate(){
    $rate = round($this->reviews->avg('rate_mark'));
    $html = "";
    if($rate != 0 ){
      for ($i = 0; $i < $rate; $i++)
        $html = $html . '<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>';
      for ($i = 0; $i < 5-$rate; $i++)
        $html = $html . '<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>';
    }else{
      for ($i = 0; $i < 5; $i++)
        $html = $html . '<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>';
    }
    return $html;
  }

  public function countReviews(){
    return count($this->reviews);
  }

  public function checkAmount(){
    return $this->amount > 0 ? 'Còn Hàng' : 'Tạm hết hàng';
  }

}
