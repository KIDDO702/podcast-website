<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolePermissions = [
            'admin' => [
                'access admin',
                'manage genre',
                'delete genre',
                'manage show',
                'delete show',
                'manage episode',
                'delete episode',
                'manage role',
                'manage permission',
                'manage user',
                'manage podcast'
            ],

            'host' => [
                'access host',
                'create show',
                'manage show',
                'delete show',
                'create episode',
                'manage episode',
                'delete episode',
            ],
        ];

        foreach ($rolePermissions as $roleName => $permissions) {
            $role = Role::where('name', $roleName)->first();
            $role->syncPermissions($permissions);
        }
    }
}
