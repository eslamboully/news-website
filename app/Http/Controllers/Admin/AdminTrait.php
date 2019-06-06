<?php

namespace App\Http\Controllers\Admin;
use App\File;
use Illuminate\Support\Facades\Storage;

trait AdminTrait{
    public $file;

    public function file_upload($path){
        if (request()->has('file')) {
            $image = request()->file('file');
            $file_name = time() . '.' . $image->getClientOriginalExtension();
            $file_size = round($image->getSize() / 1024);
            $file_mime = $image->getMimeType();
            $destinationPath = public_path('/AdminDesign/uploads/' . $path);
            $image->move($destinationPath, $file_name);
            $this->file = File::create([
                'file_name' => $file_name,
                'file_size' => $file_size,
                'file_type' => $file_mime,
            ]);
        }
    }
//    public function file_update($path){
//        if (request()->has('file')) {
//            $image = request()->file('file');
//            $file_name = time() . '.' . $image->getClientOriginalExtension();
//            $file_size = round($image->getSize() / 1024);
//            $file_mime = $image->getMimeType();
//            $destinationPath = public_path('/AdminDesign/uploads/' . $path);
//            $image->move($destinationPath, $file_name);
//            $file = File::find()->update([
//                'file_name' => $file_name,
//                'file_size' => $file_size,
//                'file_type' => $file_mime,
//            ]);
//        }
//    }
}
