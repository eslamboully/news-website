<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = ['name_ar','name_en'];
}
