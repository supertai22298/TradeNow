<?php

namespace App\Models;

use App\Http\Traits\DiffFromNow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
  use SoftDeletes, DiffFromNow;

  protected $fillable = [
    'rate_mark', 'description', 'is_incognito', 'product_id', 'user_id',
  ];
  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }
  public function product()
  {
    return $this->belongsTo('App\Models\Product');
  }

  public function showIncognito()
  {
    if ($this->is_incognito === 1) return "Ẩn danh";
    return $this->user->name;
  }
  
  public function getHtmlRate()
  {
    $html = "";
    for ($i = 0; $i < $this->rate_mark; $i++)
      $html = $html . '<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>';
    for ($i = 0; $i < 5 - $this->rate_mark; $i++)
      $html = $html . '<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>';
    return $html;
  }
}
