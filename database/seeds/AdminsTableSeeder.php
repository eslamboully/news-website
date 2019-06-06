<?php

use Illuminate\Database\Seeder;
use App\Admin\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::Create([
            'name'=>'عبدالرحمن أسامة',
            'email'=>'eslamboully@gmail.com',
            'password'=>bcrypt('123456'),
        ]);
        \App\File::create([
            'file_name' => 'default.png',
            'file_type' => 'png',
            'file_size' => '2',
        ]);
        $admin->assignRole('super_admin');
        $cat = \App\Admin\Category::create([
            'name_ar' => 'الرئيسية',
            'name_en' => 'Home',
        ]);

        $setting = \App\Admin\Setting::create([
            'name_ar'=>'اليوم التاسع',
            'name_en'=>'youm9',
            'email'=>'eslamboully@gmail.com',
            'phone'=>'01095337200',
            'status'=>'active',
            'logo' => 'default.png',
        ]);
    }
}
