<?php

namespace Database\Seeders;

use App\Models\ChklClassification;
use Illuminate\Database\Seeder;

class ChklClassificationSeeder extends Seeder {
    public function run(): void {
        ChklClassification::create([
            'description' => 'Maquinário',
            'status' => 'A'
        ]);

        ChklClassification::create([
            'description' => 'Operação',
            'status' => 'A'
        ]);

        ChklClassification::create([
            'description' => 'Limpeza',
            'status' => 'A'
        ]);

        ChklClassification::create([
            'description' => 'Segurança do Trabalho',
            'status' => 'A'
        ]);

        ChklClassification::create([
            'description' => 'Inativo',
            'status' => 'I'
        ]);
    }
}
