<?php

namespace App\Models;

use App\Http\Traits\DiffFromNow;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    //
    use SoftDeletes, DiffFromNow;
    protected $fillable = [
        'read_at'
    ];

    public function isRead()
    {
        return $this->read_at === null ? false : true;
    }
    public function isStar()
    {
        return $this->is_star;
    }
    public function toDayDateTimeString()
    {
        Carbon::setLocale('vi');
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at, 'Asia/Ho_Chi_Minh')->toDayDateTimeString();
    }
    public function limitDescription()
    {
        return \str_limit($this->description, 50, '...');
    }
    public static function countRead()
    {
        return DB::table('contacts')->where([
            ['read_at', null],
            ['deleted_at', '=', null]
        ])->get()->count();
    }
    public static function countStar()
    {
        return DB::table('contacts')->where([
            ['is_star', 1],
            ['deleted_at', '=', null]
        ])->get()->count();
    }

    public static function getEmailAndName()
    {
        return self::select('email', 'name')->where('is_subscribed', 1)->groupBy('email', 'name')->get();
    }
    public static function getAllEmail()
    {
        return self::select('email')->where('is_subscribed', 1)->groupBy('email')->get()->pluck('email')->toArray();
    }
}
