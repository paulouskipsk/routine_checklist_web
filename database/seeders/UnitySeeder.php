<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Unity;
use Illuminate\Database\Seeder;

class UnitySeeder extends Seeder
{

    public function run(): void
    {
        $addr1 = Address::create([
            'street_name' => 'Rua 01',
            'number' => 1,
            'cep' => 1111,
            'neighborhood' => 'Bairro 01',
            'complement' => 'Casa',
            "city_id" => 2021,
        ]);

        $addr2 = Address::create([
            'street_name' => 'Rua 02',
            'number' => 2,
            'cep' => 2222,
            'neighborhood' => 'Bairro 02',
            'complement' => 'Casa',
            "city_id" => 2021,
        ]);

        $addr3 = Address::create([
            'street_name' => 'Rua 03',
            'number' => 3,
            'cep' => 3333,
            'neighborhood' => 'Bairro 03',
            'complement' => 'Casa',
            "city_id" => 2021,
        ]);

        $addr4 = Address::create([
            'street_name' => 'Rua 04',
            'number' => 4,
            'cep' => 4444,
            'neighborhood' => 'Bairro 04',
            'complement' => 'Casa',
            "city_id" => 2021,
        ]);

        Unity::create([
            'fantasy_name' => 'Empresa 001',
            'corporate_name' => 'Empresa 001',
            'cnpj' => '30.346.878/4071-71',
            'state_registration' => '574.55418-70',
            'phone_fixed' => '(42) 99906-0001',
            'status' => 'A',
            'addr_id' => $addr1->id
        ]);

        Unity::create([
            'fantasy_name' => 'Empresa 002',
            'corporate_name' => 'Empresa 002',
            'cnpj' => '37.003.128/0002-08',
            'state_registration' => '737.77024-97',
            'phone_fixed' => '(42) 99906-0002',
            'status' => 'A',
            'addr_id' => $addr2->id
        ]);

        Unity::create([
            'fantasy_name' => 'Empresa 003',
            'corporate_name' => 'Empresa 003',
            'cnpj' => '16.489.335/7138-95',
            'state_registration' => '145.22827-19',
            'phone_fixed' => '(42) 99906-0003',
            'status' => 'A',
            'addr_id' => $addr3->id
        ]);

        Unity::create([
            'fantasy_name' => 'Empresa 004',
            'corporate_name' => 'Empresa 004',
            'cnpj' => '85.951.511/0694-27',
            'state_registration' => '706.17218-13',
            'phone_fixed' => '(42) 99906-0004',
            'status' => 'A',
            'addr_id' => $addr4->id
        ]);

    }
}
