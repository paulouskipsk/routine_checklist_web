<?php

namespace Database\Seeders;

use App\Models\Unity;
use Illuminate\Database\Seeder;

class UnitySeeder extends Seeder
{

    public function run(): void
    {
        Unity::create([
            'fantasy_name' => 'Empresa 001',
            'corporate_name' => 'Empresa 001',
            'cnpj' => '30.346.878/4071-71',
            'state_registration' => '574.55418-70',
            'phone_fixed' => '(42) 99906-0001',
            'status' => 'A'
        ]);

        Unity::create([
            'fantasy_name' => 'Empresa 002',
            'corporate_name' => 'Empresa 002',
            'cnpj' => '37.003.128/0002-08',
            'state_registration' => '737.77024-97',
            'phone_fixed' => '(42) 99906-0002',
            'status' => 'A'
        ]);

        Unity::create([
            'fantasy_name' => 'Empresa 003',
            'corporate_name' => 'Empresa 003',
            'cnpj' => '16.489.335/7138-95',
            'state_registration' => '145.22827-19',
            'phone_fixed' => '(42) 99906-0003',
            'status' => 'A'
        ]);

        Unity::create([
            'fantasy_name' => 'Empresa 004',
            'corporate_name' => 'Empresa 004',
            'cnpj' => '85.951.511/0694-27',
            'state_registration' => '706.17218-13',
            'phone_fixed' => '(42) 99906-0004',
            'status' => 'A'
        ]);

    }
}
