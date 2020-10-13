<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['id' => 1, 'name' => 'Administer roles & permissions', 'guard_name' => 'web'],
        ];

        foreach ($permissions as $permission) {
            $r = \Spatie\Permission\Models\Permission::create($permission);
        }
    }
}
