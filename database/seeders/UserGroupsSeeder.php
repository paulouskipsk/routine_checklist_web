<?php

namespace Database\Seeders;

use App\Models\ChklClassification;
use App\Models\Sector;
use App\Models\User;
use App\Models\UsersGroup;
use Illuminate\Database\Seeder;

class UserGroupsSeeder extends Seeder {
    public function run(): void {
        $administradores = UsersGroup::create([
            'name' => 'Administradores',
            'status' => 'A'
        ]);

        $administradores->users()->sync(User::all());
    }
}
