<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AdminResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Admin;
//use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;

class AdminsController extends Controller
{
    public function index()
    {
        $admins = AdminResource::collection(Admin::query()->get());
        return res_api($admins,200);
    }

    public function show($id)
    {
        $admin =new AdminResource(Admin::find($id));
        if ($admin){
            return res_api($admin,200);
        }else{
            return res_api($admin,404,'this id does not exist  ');
        }
    }
    public function store(Request $request){
        $rules = [
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ];
        $validate = Validator::make($request->all(),$rules);
        if ($validate->fails()){
            return res_api(null,203,$validate->errors());
        }else{

            $admin = Admin::create(['name'=>$request->name,'email'=>$request->email,'password'=>bcrypt($request->password)]);
            return res_api($admin,201,null);
        }
    }
    public function update(Request $request,$id){
        $rules = [
            'name'=>'required',
            'email'=>'required',
        ];

        $validate = Validator::make($request->all(),$rules);
        if ($validate->fails()){
            return res_api(null,203,$validate->errors());
        }else{
            if (!$request->has('password')){
                $admin = Admin::find($id)->update(['name'=>$request->name,'email'=>$request->email]);
                return res_api($admin,201,null);
            }else{
                $admin = Admin::find($id)->update(['name'=>$request->name,'email'=>$request->email,'password'=>bcrypt($request->password)]);
                return res_api($admin,201,null);
            }
        }
    }

}
