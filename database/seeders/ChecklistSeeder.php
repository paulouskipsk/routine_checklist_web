<?php

namespace Database\Seeders;

use App\Models\Checklist;
use App\Models\ChklClassification;
use App\Models\Unity;
use App\Models\UsersGroup;
use Illuminate\Database\Seeder;

class ChecklistSeeder extends Seeder {

    public function run(): void {
        
        $classMaq = ChklClassification::where('description', 'Maquinário')->first()->id; 
        $classOpe = ChklClassification::where('description', 'Operação')->first()->id; 
        $classLim = ChklClassification::where('description', 'Limpeza')->first()->id; 
        $classSeg = ChklClassification::where('description', 'Segurança do Trabalho')->first()->id; 

        $cklEmpilhadeira = Checklist::create([
            'description' => 'Checklist Empilhadeira - Início de jornada de trabalho',
            'generate_time' => '00:00:00',
            'shelflife' => 30,
            'frequency' => 'D',
            'frequency_composition' => null,
            'status' => 'A',
            'chkl_type' => 'N',
            'changed_by_user' => 1,
            'chcl_id' => $classMaq
        ]);

        $cklLimpeza = Checklist::create([
            'description' => 'Checklist Limpeza Loja',
            'generate_time' => '07:00:00',
            'shelflife' => 720,
            'frequency' => 'D',
            'frequency_composition' => null,
            'status' => 'A',
            'chkl_type' => 'N',
            'changed_by_user' => 1,
            'chcl_id' => $classLim
        ]);

        $cklSesmt = Checklist::create([
            'description' => 'Checklist Sesmt Açogue',
            'generate_time' => '06:00:00',
            'shelflife' => 720,
            'frequency' => 'S',
            'frequency_composition' => [2],
            'status' => 'A',
            'chkl_type' => 'N',
            'changed_by_user' => 1,
            'chcl_id' => $classSeg
        ]);

        $cklAbertura = Checklist::create([
            'description' => 'Checklist Abertura de Loja',
            'generate_time' => '06:00:00',
            'shelflife' => 120,
            'frequency' => 'D',
            'frequency_composition' => null,
            'status' => 'A',
            'chkl_type' => 'N',
            'changed_by_user' => 1,
            'chcl_id' => $classOpe
        ]);

        $cklPEO = Checklist::create([
            'description' => 'Checklist Pontos Extras Ofertas',
            'generate_time' => '06:00:00',
            'shelflife' => 120,
            'frequency' => 'S',
            'frequency_composition' => [5],
            'status' => 'A',
            'chkl_type' => 'N',
            'changed_by_user' => 1,
            'chcl_id' => $classOpe
        ]);

        $cklEmpilhadeira->units()->sync(Unity::all());
        $cklLimpeza->units()->sync(Unity::all());
        $cklSesmt->units()->sync(Unity::all());
        $cklAbertura->units()->sync(Unity::all());
        $cklPEO->units()->sync(Unity::all());

        $cklEmpilhadeira->usersGroups()->sync(UsersGroup::get());
        $cklLimpeza->usersGroups()->sync(UsersGroup::get());
        $cklSesmt->usersGroups()->sync(UsersGroup::get());
        $cklAbertura->usersGroups()->sync(UsersGroup::get());
        $cklPEO->usersGroups()->sync(UsersGroup::get());
    }
}
