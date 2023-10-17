<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'lastname' => 'Sistema',
            'email' => '',
            'login' =>'admin',
            'password' => '123',
            'status' => 'A',
            'access_admin' => 'S',
            'access_operator' => 'S',
            'access_mobile' => 'S',
        ]);

        User::create([
            'name' => 'Arnaldo',
            'lastname' => '',
            'email' => '',
            'login' =>'arnaldo',
            'password' => '123',
            'status' => 'A',
            'access_admin' => 'N',
            'access_operator' => 'N',
            'access_mobile' => 'N',
        ]);

        User::create([
            'name' => 'super',
            'lastname' => '',
            'email' => '',
            'login' =>'super',
            'password' => '123',
            'status' => 'A',
            'access_admin' => 'S',
            'access_operator' => 'S',
            'access_mobile' => 'S',
        ]);

        User::create([
            'name' => 'everton',
            'lastname' => '',
            'email' => '',
            'login' =>'everton',
            'password' => '123',
            'status' => 'A',
            'access_admin' => 'N',
            'access_operator' => 'N',
            'access_mobile' => 'N',
        ]);

        User::create([
            'name' => 'everaldo',
            'lastname' => '',
            'email' => '',
            'login' =>'everaldo',
            'password' => '123',
            'status' => 'A',
            'access_admin' => 'N',
            'access_operator' => 'N',
            'access_mobile' => 'N',
        ]);

        User::create([
            'name' => 'everson',
            'lastname' => '',
            'email' => '',
            'login' =>'everson',
            'password' => '123',
            'status' => 'A',
            'access_admin' => 'S',
            'access_operator' => 'S',
            'access_mobile' => 'S',
        ]);

        User::create([
            'name' => 'cleverson',
            'lastname' => '',
            'email' => '',
            'login' =>'cleverson',
            'password' => '123',
            'status' => 'A',
            'access_admin' => 'N',
            'access_operator' => 'N',
            'access_mobile' => 'N',
        ]);

        User::create([
            'name' => 'emerson',
            'lastname' => '',
            'email' => '',
            'login' =>'emerson',
            'password' => '123',
            'status' => 'A',
            'access_admin' => 'N',
            'access_operator' => 'N',
            'access_mobile' => 'N',
        ]);
    }
}
