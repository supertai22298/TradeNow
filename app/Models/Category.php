<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
      'name', 'image', 'thumbnail', 'description', 'parent_id'  
    ];
    public function parent() {
        return $this->belongsTo($this, 'parent_id', 'id');
    }

    public function childs()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function products()
    { 
        return $this->hasMany('App\Models\Prouct');
    }
}
