<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
class AdminController extends Controller
{
    public function admin_get()
    {
        if (auth()->guard('admin')->check()){
            return redirect()->route('admin.index');
        }else{
            return view('admin.login');
        }
    }

    public function admin_post()
    {
        $rememberme = request()->rememberme ? 1 : 0;
        if (auth()->guard('admin')->attempt(['email'=>request()->email,'password'=>request()->password],$rememberme)){
            return redirect()->route('admin.index');
        }else{
            Session::flash('message', __('admin.add_message'));
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
    }

    public function admin_index()
    {
        return view('admin.index');
    }

    public function admin_logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin_get');
    }

    public function admin_profile_get()
    {
        $admin = Admin::find(auth()->guard('admin')->user()->id);
        return view('admin.admins.profile',compact('admin'));
    }
    public function admin_profile_post(Request $request)
    {
        $admin = Admin::find(auth()->guard('admin')->user()->id);
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:admins,email,'.$admin->id,
        ];
        if ($request->password != null){
            $rules += ['password'=>'required|confirmed|unique:admins'];
            $data = $this->validate($request,$rules);
            $data['password'] = bcrypt($request->password);
        }else{
            $data = $this->validate($request,$rules);
        }
        if ($request->has('file')) {
            $this->file_upload('admins');
            $data['file_id'] = $this->file->id;
        }
        Admin::find($admin->id)->update($data);
        Session::flash('message', __('admin.edit_message'));
        Session::flash('alert-class', 'alert-success');
        return back();
    }
}
