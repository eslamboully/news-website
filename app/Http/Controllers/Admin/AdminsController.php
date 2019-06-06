<?php
namespace App\Http\Controllers\Admin;
use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDataTable;
use Session;
use App\Admin\Admin;
use Barryvdh\Snappy;

class AdminsController extends Controller
{
    use AdminTrait;
    public function index(AdminDataTable $admin)
    {
        if ( auth()->guard('admin')->user()->can('read_admins')){
            return $admin->render('admin.admins.index');
        }else{
            return 'you cant access into this page';
        }
    }
    public function create()
    {
        if ( auth()->guard('admin')->user()->can('add_admins')) {
            return view('admin.admins.create');
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
                $this->file_upload('admins');
                $admin = Admin::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'file_id'=>$this->file->id,
                    'password' => bcrypt($request->password),
                ]);
            }else{
                $admin = Admin::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
            }
            $admin->assignRole('sub_admin');
            $admin->givePermissionTo($request->permissions);
            Session::flash('message', __('admin.add_message'));
            Session::flash('alert-class', 'alert-success');
            return back();

    }
    public function edit($id)
    {
        if ( auth()->guard('admin')->user()->can('edit_admins')) {
            $admin = Admin::find($id);
            $file = File::find($admin->file_id);
            return view('admin.admins.edit', compact('admin','file'));

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
            $this->file_upload('admins');
            $data['file_id'] = $this->file->id;
        }
        $admin = Admin::find($id)->syncPermissions($request->permissions)->update($data);

        Session::flash('message', __('admin.edit_message'));
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('admins.index');
    }
    public function destroy($id)
    {
        if ( auth()->guard('admin')->user()->can('delete_admins')) {
            Admin::find($id)->delete();
            Session::flash('message', __('admin.destroy'));
            Session::flash('alert-class', 'alert-success');
            return back();
        }else{
            return 'you cant ';
        }
    }
    public function delete_all(Request $request)
    {
        if ( auth()->guard('admin')->user()->can('delete_admins')) {
            if (!$request->has('check_this')){
                Session::flash('message', __('admin.zero_del'));
                Session::flash('alert-class', 'alert-danger');
            }else {
                if (is_array($request->check_this)) {
                    foreach ($request->check_this as $id) {
                        Admin::find($id)->delete();
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
