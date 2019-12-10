<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    use SoftDeletes;
    protected $table = 'order_statuses';
    //
    public const ORDER_SUCCESSFUL_PRIORITY = 15;

    public static function getIdOrderSuccessful(){

        $id = self::select('id')->where('priority', self::ORDER_SUCCESSFUL_PRIORITY)->get();
        if($id && $id[0]) return $id[0]->id;
    }
}
