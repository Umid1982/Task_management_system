<?php

namespace Database\Seeders;

use App\Console\Constants\ResponseConstants\PermissionResponseEnum;
use App\Console\Constants\ResponseConstants\RoleResponseEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        Role::query()->insert([
                [
                    'name' => RoleResponseEnum::MANAGER,
                    'guard_name' => 'web',
                ],
                [
                    'name' => RoleResponseEnum::EMPLOYEE,
                    'guard_name' => 'web',
                ],
            ]);
        $user = User::query()->where('name', '=', 'umid')->first();
        $user->assignRole($role->name);

        $permissions = [
            PermissionResponseEnum::CREATE,
            PermissionResponseEnum::DELETE,
            PermissionResponseEnum::UPDATE,
            PermissionResponseEnum::SHOW,
        ];

        foreach ($permissions as $permission){
            Permission::create([
                'name'=>$permission,
                'guard_name'=>'web'
            ]);
        }
    }
}
