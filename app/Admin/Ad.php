<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';
    protected $fillable = ['name_ar','name_en','started_at','ended_at','status','file_id'];

    public function file()
    {
        return $this->hasOne('App\File','id','file_id');
    }
}
