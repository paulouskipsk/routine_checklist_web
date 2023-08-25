<?php

namespace Database\Seeders;

use App\Models\ChecklistItem;
use App\Models\Unity;
use Illuminate\Database\Seeder;

class ChecklistItemSeeder extends Seeder
{

    public function run(): void
    {
        ChecklistItem::create([
            'description' => 'Pergunta 01',
            'sequence' => 1,
            'score' => 1,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '23:59',
            'shelflife' => 10,
            'required_photo' => 'N',
            'quant_photo' => 1,
            'chkl_id' => 1,
            'sect_id' => 1,
            'changed_by_user' => 1,
        ]);

        ChecklistItem::create([
            'description' => 'Pergunta 02',
            'sequence' => 2,
            'score' => 1,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '23:59',
            'shelflife' => 10,
            'required_photo' => 'N',
            'quant_photo' => 1,
            'chkl_id' => 1,
            'sect_id' => 1,
            'changed_by_user' => 1,
        ]);

        ChecklistItem::create([
            'description' => 'Pergunta 03',
            'sequence' => 3,
            'score' => 1,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '23:59',
            'shelflife' => 10,
            'required_photo' => 'N',
            'quant_photo' => 1,
            'chkl_id' => 1,
            'sect_id' => 1,
            'changed_by_user' => 1,
        ]);

        ChecklistItem::create([
            'description' => 'Pergunta 04',
            'sequence' => 4,
            'score' => 1,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '23:59',
            'shelflife' => 10,
            'required_photo' => 'N',
            'quant_photo' => 1,
            'chkl_id' => 1,
            'sect_id' => 1,
            'changed_by_user' => 1,
        ]);

        ChecklistItem::create([
            'description' => 'Pergunta 05',
            'sequence' => 5,
            'score' => 1,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '23:59',
            'shelflife' => 10,
            'required_photo' => 'N',
            'quant_photo' => 1,
            'chkl_id' => 1,
            'sect_id' => 1,
            'changed_by_user' => 1,
        ]);

    }
}
