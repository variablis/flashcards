<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin Lastname',
            'email' => 'admin@localhost',
            'password' => Hash::make('123'),
            'is_admin' => true,
        ]);

        DB::table('users')->insert([
            'name' => 'Davis L',
            'email' => 'davis@localhost',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Janis Berzins',
            'email' => 'janis@localhost',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Anna Kalnina',
            'email' => 'anna@localhost',
            'password' => Hash::make('123'),
        ]);
    }
}
