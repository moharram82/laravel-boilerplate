<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['permission_id' => 1, 'role_id' => 1],
        ];

        foreach ($permissions as $permission) {
            $perm = PermissionRole::create($permission);
        }
    }
}
