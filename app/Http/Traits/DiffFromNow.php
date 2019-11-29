<?php

namespace App\Http\Traits;

use Carbon\Carbon;

trait DiffFromNow {
  /**
   * Trả về số ngày giờ so với hiện tại
   * vd: 1 ngày trước, 2 giờ trước, 
   * @return String
   */
  public function diffFromNow()
  {
    Carbon::setLocale('vi');
    $now = Carbon::now('Asia/Ho_Chi_Minh');

    if ($this->created_at != null) {
      $date = $this->created_at ?  Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at, 'Asia/Ho_Chi_Minh') : $now;
      return $date->diffForHumans($now);
    } else {
      return "Không xác định";
    }
  }
}