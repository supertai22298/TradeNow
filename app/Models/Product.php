<?php

namespace App\Models;

use App\Http\Traits\DiffFromNow;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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

  public function product_details()
  {
    return $this->hasMany('App\Models\ProductDetail');
  }

  public function comments()
  {
    return $this->hasMany('App\Models\Comment');
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

  public function getFirstImage() {
    return $this->product_images->count() > 0 ? $this->product_images->first()->image : 'default.png';
  }
}
