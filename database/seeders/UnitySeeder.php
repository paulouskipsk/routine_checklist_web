<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Unity;
use Illuminate\Database\Seeder;

class UnitySeeder extends Seeder {

    public function run(): void {
        $addr1 = Address::create([
            'street_name' => 'Rua Tabarana',
            'number' => 776,
            'cep' => '85860200',
            'neighborhood' => 'Vila Residencial A',
            'complement' => '',
            "city_id" => 2021,
        ]);

        $addr2 = Address::create([
            'street_name' => 'Rua Concórdia',
            'number' => 235,
            'cep' => '87206-358',
            'neighborhood' => 'Jardim Eldorado',
            'complement' => '',
            "city_id" => 2021,
        ]);

        $addr3 = Address::create([
            'street_name' => 'Praça Santa Rita de Cássia',
            'number' => 1564,
            'cep' => '85860-200',
            'neighborhood' => 'Vila Residencial A',
            'complement' => '',
            "city_id" => 2021,
        ]);

        $addr4 = Address::create([
            'street_name' => 'Rua Valdir José Alves',
            'number' => 107,
            'cep' => '84060-570',
            'neighborhood' => 'Contorno',
            'complement' => '',
            "city_id" => 2021,
        ]);

        $addr5 = Address::create([
            'street_name' => 'Rua Galo-da-serra',
            'number' => 776,
            'cep' => '85814-660',
            'neighborhood' => 'Pinheirinho',
            'complement' => '',
            "city_id" => 2021,
        ]);

        $addr6 = Address::create([
            'street_name' => 'Travessa Catalão',
            'number' => 393,
            'cep' => '85862-377',
            'neighborhood' => 'Jardim Vasco da Gama',
            'complement' => '',
            "city_id" => 2021,
        ]);

        $addr7 = Address::create([
            'street_name' => 'Rua das Goiabeiras',
            'number' => 876,
            'cep' => '85060-560',
            'neighborhood' => 'Conradinho',
            'complement' => '',
            "city_id" => 2021,
        ]);

        $addr8 = Address::create([
            'street_name' => 'Rua Valdomiro Estanislau Jung',
            'number' => 239,
            'cep' => '85867-340',
            'neighborhood' => 'Jardim Porto Belo',
            'complement' => '',
            "city_id" => 2021,
        ]);

        $addr9 = Address::create([
            'street_name' => 'Conjunto Residencial Vinte e Seis de Junho',
            'number' => 816,
            'cep' => '87508-087',
            'neighborhood' => 'Rua Patriarca José',
            'complement' => '',
            "city_id" => 2021,
        ]);

        $addr10 = Address::create([
            'street_name' => 'Praça das Hortênsias',
            'number' => 159,
            'cep' => '83601-535',
            'neighborhood' => 'Vila Bancária',
            'complement' => '',
            "city_id" => 2021,
        ]);

//===============================================================
        Unity::create([
            'id' => 1,
            'fantasy_name' => 'Unidade 001',
            'corporate_name' => 'Supermercado Fictício SA',
            'cnpj' => '43.341.216/0001-01',
            'state_registration' => '479.42152-01',
            'phone_fixed' => '(45) 3707-0001',
            'status' => 'A',
            'addr_id' => $addr1->id
        ]);

        Unity::create([
            'id' => 2,
            'fantasy_name' => 'Unidade 002',
            'corporate_name' => 'Supermercado Fictício SA',
            'cnpj' => '43.341.216/0001-02',
            'state_registration' => '479.42152-02',
            'phone_fixed' => '(42) 99906-0002',
            'status' => 'A',
            'addr_id' => $addr2->id
        ]);

        Unity::create([
            'id' => 3,
            'fantasy_name' => 'Unidade 003',
            'corporate_name' => 'Supermercado Fictício SA',
            'cnpj' => '43.341.216/0001-03',
            'state_registration' => '479.42152-03',
            'phone_fixed' => '(42) 99906-0003',
            'status' => 'A',
            'addr_id' => $addr3->id
        ]);

        Unity::create([
            'id' => 4,
            'fantasy_name' => 'Unidade 004',
            'corporate_name' => 'Supermercado Fictício SA',
            'cnpj' => '43.341.216/0001-04',
            'state_registration' => '479.42152-04',
            'phone_fixed' => '(42) 99906-0004',
            'status' => 'A',
            'addr_id' => $addr4->id
        ]);

        Unity::create([
            'id' => 5,
            'fantasy_name' => 'Unidade 005',
            'corporate_name' => 'Supermercado Fictício SA',
            'cnpj' => '43.341.216/0001-05',
            'state_registration' => '479.42152-05',
            'phone_fixed' => '(42) 99906-0005',
            'status' => 'A',
            'addr_id' => $addr5->id
        ]);

        Unity::create([
            'id' => 6,
            'fantasy_name' => 'Unidade 006',
            'corporate_name' => 'Supermercado Fictício SA',
            'cnpj' => '43.341.216/0001-06',
            'state_registration' => '479.42162-06',
            'phone_fixed' => '(42) 99906-0006',
            'status' => 'A',
            'addr_id' => $addr6->id
        ]);

        Unity::create([
            'id' => 7,
            'fantasy_name' => 'Unidade 007',
            'corporate_name' => 'Supermercado Fictício SA',
            'cnpj' => '43.341.217/0001-07',
            'state_registration' => '479.42172-07',
            'phone_fixed' => '(42) 99907-0007',
            'status' => 'A',
            'addr_id' => $addr7->id
        ]);

        Unity::create([
            'id' => 8,
            'fantasy_name' => 'Unidade 008',
            'corporate_name' => 'Supermercado Fictício SA',
            'cnpj' => '43.341.218/0001-08',
            'state_registration' => '489.42182-08',
            'phone_fixed' => '(42) 99908-0008',
            'status' => 'A',
            'addr_id' => $addr8->id
        ]);

        Unity::create([
            'id' => 9,
            'fantasy_name' => 'Unidade 009',
            'corporate_name' => 'Supermercado Fictício SA',
            'cnpj' => '43.341.219/0001-09',
            'state_registration' => '499.42192-09',
            'phone_fixed' => '(42) 99909-0009',
            'status' => 'A',
            'addr_id' => $addr9->id
        ]);

        Unity::create([
            'id' => 10,
            'fantasy_name' => 'Unidade 010',
            'corporate_name' => 'Supermercado Fictício SA',
            'cnpj' => '43.341.219/0001-10',
            'state_registration' => '499.42192-10',
            'phone_fixed' => '(42) 99909-0010',
            'status' => 'A',
            'addr_id' => $addr10->id
        ]);
    }
}
