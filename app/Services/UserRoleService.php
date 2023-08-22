<?php

namespace App\Services;

use Spatie\Permission\Models\Role;

class UserRoleService
{
    public function createRole($name, $email, $role_name, $user)
    {
        if (auth()->user()->hasRole('admin')){
            $role = Role::query()->where('name', '=', $role_name)->first();
            $user->roles()->detach();
            $user->assignRole($role->name);
            $user->update([
                'name' => $name,
                'role_name' => $role->name,
            ]);
            return $user;
        }
        return false;
    }

    public function savePermission($role_name,$permission_id,$user)
    {
        if ($user->hasRole($role_name)) {
            $user->givePermissionTo($permission_id);
           return $user;
        }
        return [
            'message' => 'not role this user',
            'success' => false,
        ];
    }
}
