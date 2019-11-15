<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'read_at'
    ];

    public function isRead() {
        return $this->read_at === null ? false: true; 
    }
    public function isStar() {
        return $this->is_star; 
    }

    public function diffFromNow() {
        Carbon::setLocale('vi');
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        
        $date = $this->created_at ?  Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at, 'Asia/Ho_Chi_Minh'): $now;
        return $date->diffForHumans($now);
    }

    public function toDayDateTimeString() {
        Carbon::setLocale('vi');
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at, 'Asia/Ho_Chi_Minh')->toDayDateTimeString();
    }
    public function limitDescription() {
        return \str_limit($this->description, 50, '...');
    }
    public static function countRead() {
        return DB::table('contacts')->where([
            ['read_at', null],
            ['deleted_at','=', null]
        ])->get()->count();
    }
    public static function countStar() {
        return DB::table('contacts')->where([
            ['is_star', 1],
            ['deleted_at','=', null]
        ])->get()->count();
    }
}

