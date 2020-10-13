<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['id' => 1, 'name' => 'Mohammed Moharram', 'email' => 'moharram82@hotmail.com', 'password' => Hash::make('12345678'), 'profile_picture' => null], // Admin
            ['id' => 2, 'name' => 'Osman Moharram', 'email' => 'osman@hotmail.com', 'password' => Hash::make('12345678'), 'profile_picture' => null], // Author
        ];

        foreach ($users as $user) {
            $r = User::create($user);
        }

        //\App\Models\User::factory(10)->create();
    }
}
