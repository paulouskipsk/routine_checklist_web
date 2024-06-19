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
            'lastname' => 'Geral',
            'email' => '',
            'login' =>'admin',
            'password' => 'utfprgp',
            'status' => 'A',
            'access_admin' => 'S',
            'access_operator' => 'S',
            'access_mobile' => 'S',
        ]);

        User::create([
            'name' => 'Everton',
            'lastname' => 'UTFPR',
            'email' => '',
            'login' =>'everton',
            'password' => 'utfprgp',
            'status' => 'A',
            'access_admin' => 'S',
            'access_operator' => 'S',
            'access_mobile' => 'S',
        ]);

        User::create([
            'name' => 'super',
            'lastname' => '',
            'email' => '',
            'login' =>'super',
            'password' => 'utfprgp',
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
            'password' => 'utfprgp',
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
            'password' => 'utfprgp',
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
            'password' => 'utfprgp',
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
            'password' => 'utfprgp',
            'status' => 'A',
            'access_admin' => 'S',
            'access_operator' => 'N',
            'access_mobile' => 'N',
        ]);

        User::create([
            'name' => 'emerson',
            'lastname' => '',
            'email' => '',
            'login' =>'emerson',
            'password' => 'utfprgp',
            'status' => 'A',
            'access_admin' => 'N',
            'access_operator' => 'N',
            'access_mobile' => 'S',
        ]);

        User::create([
            'name' => 'Operador',
            'lastname' => '',
            'email' => '',
            'login' =>'operador',
            'password' => 'utfprgp',
            'status' => 'A',
            'access_admin' => 'N',
            'access_operator' => 'N',
            'access_mobile' => 'S',
        ]);

    }
}
