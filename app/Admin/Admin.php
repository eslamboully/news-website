<?php

namespace App\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{

    use Notifiable,HasRoles;
    protected $guard_name = 'admin';
    protected $fillable = [
        'file_id','name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function file()
    {
        return $this->hasOne('App\File','id','file_id');
    }
}
