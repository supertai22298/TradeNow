<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    //
    public const CHECKED = 1;

    public static function getNumberOfRow($checked = 0)
    {
        $conditions = [];
        if($checked === 1) array_push($conditions, ['is_checked', self::CHECKED]);
        
        return self::where($conditions)->get()->count();
    }
}
