<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = ['file_name','file_type','file_size'];

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }
}
