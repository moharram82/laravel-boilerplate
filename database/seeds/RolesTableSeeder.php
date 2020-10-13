<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'Admin', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'Normal', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            $r = \Spatie\Permission\Models\Role::create($role);
        }
    }
}
