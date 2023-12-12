<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create genre',
            'manage genre',
            'delete genre',
            'create show',
            'manage show',
            'delete show',
            'create episode',
            'manage episode',
            'delete episode',
            'approve comment',
            'manage comment',
            'create role',
            'manage role',
            'assign role',
            'revoke role',
            'delete role',
            'create permission',
            'manage permission',
            'assign permission',
            'revoke permission',
            'delete permission',
            'create user',
            'manage user',
            'delete user',
            'access admin',
            'access host',
            'manage podcast',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
