<?php

namespace App\Http\Controllers\Admin;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\UserDataTable;
use Session;
use App\User;
use Barryvdh\Snappy;

class UsersController extends Controller
{
    use AdminTrait;
    public function index(UserDataTable $user)
    {
        if ( auth()->guard('admin')->user()->can('read_users')){
            return $user->render('admin.users.index');
        }else{
            return 'you cant access into this page';
        }
    }
    public function create()
    {
        if ( auth()->guard('admin')->user()->can('add_users')) {
            return view('admin.users.create');
        }else{
            return 'you cant access into this page';
        }
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'required|confirmed|min:6',
        ];
        $this->validate($request, $rules);
        if ($request->has('file')) {
            $this->file_upload('users');
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'file_id'=>$this->file->id,
                'password' => bcrypt($request->password),
            ]);
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'file_id'=>'1',
            ]);
        }
        Session::flash('message', __('admin.add_message'));
        Session::flash('alert-class', 'alert-success');
        return back();
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        if ( auth()->guard('admin')->user()->can('edit_users')) {
            $user = User::find($id);
            $file = File::find($user->file_id);
            //dd($user);
            return view('admin.users.edit', compact('user','file'));

        }else{
            return 'yuo assdas';
        }
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:admins,email,'.$id,
        ];
        if ($request->password != null){
            $rules += ['password'=>'required|confirmed|unique:admins'];
            $data = $this->validate($request,$rules);
            $data['password'] = bcrypt($request->password);
        }else{
            $data = $this->validate($request,$rules);
        }
        if ($request->has('file')) {
            $this->file_upload('users');
            $data['file_id'] = $this->file->id;
        }
        $user = User::find($id)->update($data);

        Session::flash('message', __('admin.edit_message'));
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('users.index');
    }
    public function destroy($id)
    {
        if ( auth()->guard('admin')->user()->can('delete_users')) {
            User::find($id)->delete();
            Session::flash('message', __('admin.destroy'));
            Session::flash('alert-class', 'alert-success');
            return back();
        }else{
            return 'you cant ';
        }
    }
    public function delete_all(Request $request)
    {
        if ( auth()->guard('admin')->user()->can('delete_users')) {
            if (!$request->has('check_this')){
                Session::flash('message', __('admin.zero_del'));
                Session::flash('alert-class', 'alert-danger');
            }else {
                if (is_array($request->check_this)) {
                    foreach ($request->check_this as $id) {
                        User::find($id)->delete();
                    }
                }
                Session::flash('message', __('admin.destroy'));
                Session::flash('alert-class', 'alert-success');
            }
            return back();
        }else{
            return 'you cant ';
        }
    }
}
