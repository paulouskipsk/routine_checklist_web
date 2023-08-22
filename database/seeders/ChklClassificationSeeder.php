<?php

namespace Database\Seeders;

use App\Models\ChklClassification;
use Illuminate\Database\Seeder;

class ChklClassificationSeeder extends Seeder
{

    public function run(): void
    {
        ChklClassification::create([
            'description' => 'Checklist ADM',
            'status' => 'A'
        ]);

        ChklClassification::create([
            'description' => 'Checklist Operacional',
            'status' => 'A'
        ]);

        ChklClassification::create([
            'description' => 'Checklist Maquinas',
            'status' => 'A'
        ]);

        ChklClassification::create([
            'description' => 'Checklist Sesmt',
            'status' => 'A'
        ]);
    }
}
