<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Unity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder {

    public function run(): void {
        
        $SQL = "INSERT INTO public.states (name, code, acronym, status, created_at, updated_at) VALUES ";
        $SQL .= "('Goiás', 52, 'GO', 'A', now(), now()),";
        $SQL .= "('Minas Gerais', 31, 'MG', 'A', now(), now()),";
        $SQL .= "('Pará', 15, 'PA', 'A', now(), now()),";
        $SQL .= "('Ceará', 23, 'CE', 'A', now(), now()),";
        $SQL .= "('Bahia', 29, 'BA', 'A', now(), now()),";
        $SQL .= "('Paraná', 41, 'PR', 'A', now(), now()),";
        $SQL .= "('Santa Catarina', 42, 'SC', 'A', now(), now()),";
        $SQL .= "('Pernambuco', 26, 'PE', 'A', now(), now()),";
        $SQL .= "('Tocantins', 17, 'TO', 'A', now(), now()),";
        $SQL .= "('Maranhão', 21, 'MA', 'A', now(), now()),";
        $SQL .= "('Rio Grande do Norte', 24, 'RN', 'A', now(), now()),";
        $SQL .= "('Piauí', 22, 'PI', 'A', now(), now()),";
        $SQL .= "('Rio Grande do Sul', 43, 'RS', 'A', now(), now()),";
        $SQL .= "('Mato Grosso', 51, 'MT', 'A', now(), now()),";
        $SQL .= "('Acre', 12, 'AC', 'A', now(), now()),";
        $SQL .= "('São Paulo', 35, 'SP', 'A', now(), now()),";
        $SQL .= "('Espírito Santo', 32, 'ES', 'A', now(), now()),";
        $SQL .= "('Alagoas', 27, 'AL', 'A', now(), now()),";
        $SQL .= "('Paraíba', 25, 'PB', 'A', now(), now()),";
        $SQL .= "('Mato Grosso do Sul', 50, 'MS', 'A', now(), now()),";
        $SQL .= "('Rondônia', 11, 'RO', 'A', now(), now()),";
        $SQL .= "('Roraima', 14, 'RR', 'A', now(), now()),";
        $SQL .= "('Amazonas', 13, 'AM', 'A', now(), now()),";
        $SQL .= "('Amapá', 16, 'AP', 'A', now(), now()),";
        $SQL .= "('Sergipe', 28, 'SE', 'A', now(), now()),";
        $SQL .= "('Rio de Janeiro', 33, 'RJ', 'A', now(), now()),";
        $SQL .= "('Distrito Federal', 53, 'DF', 'A', now(), now())";
        DB::statement($SQL);
    }
}
