<?php

namespace App\Models;

use App\Http\Traits\DiffFromNow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes, DiffFromNow;

    protected $fillable = [
        'reply', 'replied_at'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function isReplied() {
        if($this->replied_at == null) return false;
        return true;
    }

}
