<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            [
                'name' => 'Sahan',
                'role' => 'admin',
                'email' => 'sahan@gmail.com',
                'phone' => '0766000009',
                'address' => 'Galle',
                'NIC' => '966666632v',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'user01',
                'role' => 'user',
                'email' => 'user@gmail.com',
                'phone' => '0766000888',
                'address' => 'Galle',
                'NIC' => '967766632v',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
