<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //
    protected $fillable = [
        'type', 'code', 'title', 'description','reduction_level','banner','banner_thumbnail','started_at','finished_at'
    ];
}
