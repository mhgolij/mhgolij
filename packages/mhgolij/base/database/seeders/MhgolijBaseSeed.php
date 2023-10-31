<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use mhgolij\base\http\Models\Partial;
use mhgolij\base\http\Models\UserGroup;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class MhgolijBaseSeed extends \Illuminate\Database\Seeder
{
    public function  run() : void{
        $adminGroup = UserGroup::create([
            'code'=>'admins',
            'name'=>'ادمین ها',
            'is_admin'=>1
        ]);
        $user = User::create([
            'user_name' =>'admin',
            'email' =>'admin@admin.com',
            'is_admin' =>1,
            'password' =>Hash::make(12345678),
            'name'=>'محمدحسین',
            'last_name' =>'گلی',
            'group_id'=>$adminGroup->id
        ]);
        $roles = [
            [
                'name'=>'superAdmin',
                'fa_name'=>'ادمین کل',
                'guard_name'=>'web'
            ]
        ];
        $permissions = [
            [
                'name'=>'usersManage',
                'fa_name'=>'مدیریت کاربران',
                'guard_name'=>'web'
            ],
            [
                'name'=>'rolesManage',
                'fa_name'=>'مدیریت نقش ها',
                'guard_name'=>'web'
            ],
            [
                'name'=>'userGroupsManage',
                'fa_name'=>'مدیریت گروه های کاریری',
                'guard_name'=>'web'
            ]
        ];
        foreach ($roles as $role){
            $role = Role::create($role);
            foreach ($permissions as $permission){
                $per = Permission::create($permission);
                $role->givePermissionTo($per);
            }
        }
        $user->assignRole('superAdmin');

        Partial::create([
            'code' => 'right-side-bar',
            'address'=>'mhgolijBase::admin.partials.right-sidebar',
            'order'=>1
        ]);
    }
}
