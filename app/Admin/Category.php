<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name_ar','name_en','parent_id'];

    public function category()
    {
            return $this->hasOne('App\Admin\Category','id','parent_id');
    }
}
