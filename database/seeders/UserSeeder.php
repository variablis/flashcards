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
            'name' => 'Admin',
            'email' => 'admin@localhost',
            'password' => Hash::make('123'),
            'avatar' => 'https://gravatar.com/avatar/'.md5( strtolower( trim( "admin@localhost" ) ) ).'?d=identicon',
            'is_admin' => true,
        ]);

        DB::table('users')->insert([
            'name' => 'Dāvis Liekniņš',
            'email' => 'davis@localhost',
            'password' => Hash::make('123'),
            'avatar' => 'https://gravatar.com/avatar/'.md5( strtolower( trim( "davis@localhost" ) ) ).'?d=identicon',
        ]);

        DB::table('users')->insert([
            'name' => 'Jānis Bērziņš',
            'email' => 'janis@localhost',
            'password' => Hash::make('123'),
            'avatar' => 'https://gravatar.com/avatar/'.md5( strtolower( trim( "janis@localhost" ) ) ).'?d=identicon',
        ]);

        DB::table('users')->insert([
            'name' => 'Anna Kalniņa',
            'email' => 'anna@localhost',
            'password' => Hash::make('123'),
            'avatar' => 'https://gravatar.com/avatar/'.md5( strtolower( trim( "anna@localhost" ) ) ).'?d=identicon',
        ]);

        DB::table('users')->insert([
            'name' => 'Māra Lejiņa',
            'email' => 'mara@localhost',
            'password' => Hash::make('123'),
            'avatar' => 'https://gravatar.com/avatar/'.md5( strtolower( trim( "mara@localhost" ) ) ).'?d=identicon',
        ]);

        DB::table('users')->insert([
            'name' => 'Māris Upītis',
            'email' => 'maris@localhost',
            'password' => Hash::make('123'),
            'avatar' => 'https://gravatar.com/avatar/'.md5( strtolower( trim( "maris@localhost" ) ) ).'?d=identicon',
        ]);

        DB::table('users')->insert([
            'name' => 'Andris Kalējs',
            'email' => 'andris@localhost',
            'password' => Hash::make('123'),
            'avatar' => 'https://gravatar.com/avatar/'.md5( strtolower( trim( "andris@localhost" ) ) ).'?d=identicon',
        ]);

        DB::table('users')->insert([
            'name' => 'Zane Kalnabērza',
            'email' => 'zane@localhost',
            'password' => Hash::make('123'),
            'avatar' => 'https://gravatar.com/avatar/'.md5( strtolower( trim( "zane@localhost" ) ) ).'?d=identicon',
        ]);

        DB::table('users')->insert([
            'name' => 'Ieva Kārkla',
            'email' => 'ieva@localhost',
            'password' => Hash::make('123'),
            'avatar' => 'https://gravatar.com/avatar/'.md5( strtolower( trim( "ieva@localhost" ) ) ).'?d=identicon',
        ]);
    }
}
