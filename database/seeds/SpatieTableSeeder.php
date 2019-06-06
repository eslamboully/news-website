<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SpatieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_role = Role::create(['guard_name'=>'admin','name' => 'super_admin']);
        $sub_role   = Role::create(['guard_name'=>'admin','name' => 'sub_admin']);

        $permissions_type = ['add','edit','read','delete'];
        $models = ['admins','users','countries','categories','ads','news'];
        foreach ($permissions_type as $per){
            foreach ($models as $mod){
                Permission::create(['guard_name'=>'admin','name' => $per.'_'.$mod]);
            }
        }
        $super_role->givePermissionTo(Permission::all());

    }
}
