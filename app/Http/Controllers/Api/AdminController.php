<?php

namespace App\Http\Controllers\Api;

use App\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function admin_post()
    {
//        $rememberme = request()->rememberme ? 1 : 0;
//        if (auth()->guard('admin')->attempt(['email'=>request()->email,'password'=>request()->password],$rememberme)){
//            $auth_id = auth()->guard('admin')->user()->id;
//            Admin::find($auth_id)->update('api_token',str_random(50));
//            return res_api(auth()->guard('admin')->user(),200);
//        }else{
//            return res_api(null,405,'password is not correct');
//        }
    }
}
