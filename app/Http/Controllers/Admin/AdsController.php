<?php

namespace App\Http\Controllers\Admin;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\AdDataTable;
use Session;
use App\Admin\Ad;
use Barryvdh\Snappy;

class AdsController extends Controller
{
    use AdminTrait;
    public function index(AdDataTable $cat)
    {
        if ( auth()->guard('admin')->user()->can('read_ads')){
            return $cat->render('admin.ads.index');
        }else{
            return 'you cant access into this page';
        }
    }
    public function create()
    {
        if ( auth()->guard('admin')->user()->can('add_ads')) {
            return view('admin.ads.create');
        }else{
            return 'you cant access into this page';
        }
    }
    public function store(Request $request)
    {
        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'status' => 'required',
            'started_at' => 'required',
            'ended_at' => 'required',
            'file' => 'required|image|mimes:jpg,png,jpeg',
        ];
        $this->validate($request, $rules);
        $this->file_upload('ads');
            $ad = Ad::create([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'status' => $request->status,
                'started_at' => $request->started_at,
                'ended_at' => $request->ended_at,
                'file_id' => $this->file->id,
            ]);
        Session::flash('message', __('admin.add_message'));
        Session::flash('alert-class', 'alert-success');
        return back();
    }
    public function edit($id)
    {
        if ( auth()->guard('admin')->user()->can('edit_ads')) {
            $ad = Ad::find($id);
            $file = File::find($ad->file_id);
            //dd($user);
            return view('admin.ads.edit', compact('ad','file'));

        }else{
            return 'yuo assdas';
        }
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'status' => 'required',
            'started_at' => 'required',
            'ended_at' => 'required',
        ];
        $this->validate($request, $rules);
        if ($request->has('file')){
            $this->file_upload('ads');
            $ad = Ad::find($id)->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'status' => $request->status,
                'started_at' => $request->started_at,
                'ended_at' => $request->ended_at,
                'file_id' => $this->file->id,
            ]);
        }else{
            $ad = Ad::find($id)->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'status' => $request->status,
                'started_at' => $request->started_at,
                'ended_at' => $request->ended_at,
            ]);
        }
        Session::flash('message', __('admin.edit_message'));
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('ads.index');
    }
    public function destroy($id)
    {
        if ( auth()->guard('admin')->user()->can('delete_ads')) {
            Ad::find($id)->delete();
            Session::flash('message', __('admin.destroy'));
            Session::flash('alert-class', 'alert-success');
            return back();
        }else{
            return 'you cant ';
        }
    }
    public function delete_all(Request $request)
    {
        if ( auth()->guard('admin')->user()->can('delete_ads')) {
            if (!$request->has('check_this')){
                Session::flash('message', __('admin.zero_del'));
                Session::flash('alert-class', 'alert-danger');
            }else {
                if (is_array($request->check_this)) {
                    foreach ($request->check_this as $id) {
                        Ad::findOrFail($id)->delete();
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

    public function change_status($id)
    {
        $ad = Ad::find($id);
        if ($ad->status == 'active'){
            $ad->update([
                'status' => 'pending'
            ]);
        }else{
            $ad->update([
                'status' => 'active'
            ]);
        }
        return back();
    }
}
