<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleHasPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Read',  // 読み込み
            'Write', // 書き込み
        ];
        $role = Role::findByName('admin');
        $role->givePermissionTo($permissions);

        $permissions = [
            'Read',  // 読み込み
        ];
        $role = Role::findByName('staff');
        $role->givePermissionTo($permissions);

        // $permissions = [
        //     'Read',  // 読み込み
        // ];
        // $role = Role::findByName('common');
        // $role->givePermissionTo($permissions);
    }
}
