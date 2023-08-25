<?php

namespace Database\Seeders;

use App\Models\Checklist;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChecklistSeeder extends Seeder
{

    public function run(): void
    {
        Checklist::create([
            'description' => 'Checklist Operação de Maquinas',
            'generate_time' => '00:00:00',
            'shelflife' => 1,
            'frequency' => 'D',
            'frequency_composition' => null,
            'status' => 'A',
            'chkl_type' => 'N',
            'changed_by_user' => 1,
            'chcl_id' => 1
        ]);

        Checklist::create([
            'description' => 'Checklist Operacional',
            'generate_time' => '00:00:00',
            'shelflife' => 1,
            'frequency' => 'D',
            'frequency_composition' => null,
            'status' => 'A',
            'chkl_type' => 'N',
            'changed_by_user' => 1,
            'chcl_id' => 2
        ]);

        Checklist::create([
            'description' => 'Checklist Gerencia',
            'generate_time' => '00:00:00',
            'shelflife' => 1,
            'frequency' => 'D',
            'frequency_composition' => null,
            'status' => 'A',
            'chkl_type' => 'N',
            'changed_by_user' => 1,
            'chcl_id' => 1
        ]);

        Checklist::create([
            'description' => 'Checklist Sesmt',
            'generate_time' => '00:00:00',
            'shelflife' => 1,
            'frequency' => 'D',
            'frequency_composition' => null,
            'status' => 'A',
            'chkl_type' => 'N',
            'changed_by_user' => 1,
            'chcl_id' => 2
        ]);
    }
}
