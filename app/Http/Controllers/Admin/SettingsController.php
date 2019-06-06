<?php

namespace App\Http\Controllers\Admin;

use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Setting;
use Session;

class SettingsController extends Controller
{
    use AdminTrait;
    public function setting()
    {
        $setting = Setting::find(1);
        return view('admin.settings',compact('setting'));
    }
    public function settings(Request $request)
    {
        $setting = Setting::find(1);
        if ($request->has('file')) {
            $this->file_upload('settings');
            $setting->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->status,
                'logo'  => $this->file->file_name,
            ]);
        }else{
            $setting->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->status,
            ]);
        }
        return back();
    }
}
