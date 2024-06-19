<?php

namespace Database\Seeders;

use App\Models\ChklClassification;
use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorsSeeder extends Seeder
{

    public function run(): void
    {
        Sector::create([
            'description' => 'Açougue',
            'status' => 'A'
        ]);

        Sector::create([
            'description' => 'Padaria',
            'status' => 'A'
        ]);

        Sector::create([
            'description' => 'Mercearia',
            'status' => 'A'
        ]);

        Sector::create([
            'description' => 'Hortifrutti',
            'status' => 'A'
        ]);

        Sector::create([
            'description' => 'Fr. Caixa',
            'status' => 'A'
        ]);

        Sector::create([
            'description' => 'Depósito',
            'status' => 'A'
        ]);

        Sector::create([
            'description' => 'Inativo',
            'status' => 'I'
        ]);
    }
}
