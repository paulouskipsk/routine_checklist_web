<?php

namespace Database\Seeders;

use App\Models\Unity;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{

    public function run(): void
    {
        $password = "utfprgp@tsi";
        $user1 = User::create([
            'name' => 'Administrador',
            'lastname' => 'Geral',
            'email' => '',
            'login' =>'admin',
            'password' => $password,
            'status' => 'A',
            'access_admin' => 'S',
            'access_operator' => 'S',
            'access_mobile' => 'S',
        ]);

        $user2 = User::create([
            'name' => 'Everton',
            'lastname' => 'UTFPR',
            'email' => '',
            'login' =>'everton',
            'password' => $password,
            'status' => 'A',
            'access_admin' => 'S',
            'access_operator' => 'S',
            'access_mobile' => 'S',
        ]);

        $user3 = User::create([
            'name' => 'super',
            'lastname' => '',
            'email' => '',
            'login' =>'super',
            'password' => $password,
            'status' => 'A',
            'access_admin' => 'S',
            'access_operator' => 'S',
            'access_mobile' => 'S',
        ]);

        $user4 = User::create([
            'name' => 'everton',
            'lastname' => '',
            'email' => '',
            'login' =>'everton',
            'password' => $password,
            'status' => 'A',
            'access_admin' => 'N',
            'access_operator' => 'N',
            'access_mobile' => 'N',
        ]);

        $user5 = User::create([
            'name' => 'everaldo',
            'lastname' => '',
            'email' => '',
            'login' =>'everaldo',
            'password' => $password,
            'status' => 'A',
            'access_admin' => 'N',
            'access_operator' => 'N',
            'access_mobile' => 'N',
        ]);

        $user6 = User::create([
            'name' => 'everson',
            'lastname' => '',
            'email' => '',
            'login' =>'everson',
            'password' => $password,
            'status' => 'A',
            'access_admin' => 'S',
            'access_operator' => 'S',
            'access_mobile' => 'S',
        ]);

        $user7 = User::create([
            'name' => 'cleverson',
            'lastname' => '',
            'email' => '',
            'login' =>'cleverson',
            'password' => $password,
            'status' => 'A',
            'access_admin' => 'S',
            'access_operator' => 'N',
            'access_mobile' => 'N',
        ]);

        $user8 = User::create([
            'name' => 'emerson',
            'lastname' => '',
            'email' => '',
            'login' =>'emerson',
            'password' => $password,
            'status' => 'A',
            'access_admin' => 'N',
            'access_operator' => 'N',
            'access_mobile' => 'S',
        ]);

        $user9 = User::create([
            'name' => 'Operador',
            'lastname' => '',
            'email' => '',
            'login' =>'operador',
            'password' => $password,
            'status' => 'A',
            'access_admin' => 'N',
            'access_operator' => 'N',
            'access_mobile' => 'S',
        ]);

        $unitsIds = Unity::all()->pluck('id');

        $user1->units()->sync($unitsIds);
        $user2->units()->sync($unitsIds);
        $user3->units()->sync($unitsIds);
        $user4->units()->sync($unitsIds);
        $user5->units()->sync($unitsIds);
        $user6->units()->sync($unitsIds);
        $user7->units()->sync($unitsIds);
        $user8->units()->sync($unitsIds);
        $user9->units()->sync($unitsIds);
    }
}
