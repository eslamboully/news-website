<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = ['title','content','started_at','ended_at','status','file','admin_id','country_id','category_id'];

    public function admin()
    {
        return $this->hasOne('App\Admin\Admin','id','admin_id');
    }

    public function country()
    {
        return $this->hasOne('App\Admin\Country','id','country_id');
    }

    public function category()
    {
        return $this->hasOne('App\Admin\Category','id','category_id');
    }
}
