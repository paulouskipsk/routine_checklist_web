<?php

namespace Tests\App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Unity;
use App\Utils\Functions;
use Tests\TestCase;

class UnityControllerTest extends TestCase {

    public function testIndexSuccessLogged(): void {
        $headers = $this->getHeaderWEB();
        $response = $this->get('/unidade/listar', $headers);
        $response->assertStatus(200);
        $response->assertViewIs('registrations.unity.list');
        $response->assertSeeText('Listar Unidades');
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testIndexFailNotLogged(): void {
        $response = $this->get('/unidade/listar');
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testNewSuccessLogged(): void {
        $response = $this->get('/unidade/novo', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.unity.new');
        $response->assertSeeTextInOrder(['Home', 'Listar Unidades', 'Novo']);
        $response->assertSeeText('Salvar');
    }

    public function testNewFailNotLogged(): void {
        $response = $this->get('/unidade/novo');
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testStoreFailNotLogged(): void {
        $params = $this->getUnity(true);
        $response = $this->post('unidade/salvar', $params);
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testStoreSuccess(): void {
        $params = $this->getUnity(true);
        $response = $this->post('/unidade/salvar/',$params, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertRedirectContains('/unidade/novo');
        $response->assertSessionHas('flash-success-msg', 'Unidade cadastrada com sucesso.');
    }

    public function testEditSuccessLogged(): void {
        $response = $this->get('/unidade/editar/1', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.unity.edit');
        $response->assertSeeTextInOrder(['Home', 'Listar Unidades', 'Editar']);
        $response->assertSeeText('Salvar');
    }
    public function testEditFailNotLogged(): void {
        $unity = Unity::first();
        $response = $this->get('/unidade/editar/'.$unity->id);
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testUpdateFailNotLogged(): void {
        $unity = Unity::first()->toArray();
        $unity['description'] = 'Unidade '.uniqid();
        $response = $this->put('/unidade/atualizar/'.$unity['id'], $unity);
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }
    public function testUpdateSuccess(): void {
        $params = $this->getUnity(false);
        $headers = $this->getHeaderWEB();
        $response = $this->put('/unidade/atualizar/'.$params['unity']['id'], $params, $headers);
        $response->assertStatus(302);
        $response->assertRedirectContains('/unidade/listar');
        $response->assertSessionHas('flash-success-msg', 'Unidade atualizada com sucesso.');
    }

    private function  getUnity(bool $isNew){
        $unity = Unity::where('fantasy_name', 'Unidade Teste')->first();
        if(!Functions::nullOrEmpty($unity)) $unity->delete();
        
        $addr = [
            'street_name' => 'Rua Tabarana',
            'number' => 776,
            'cep' => '85860200',
            'neighborhood' => 'Vila Residencial A',
            'complement' => '',
            "city_id" => 2021,
        ];
        
        $unityData = [
            'fantasy_name' => 'Unidade Teste',
            'corporate_name' => 'Unidade Teste',
            'cnpj' => '11.111.111/1111-11',
            'state_registration' => '111.11111-11',
            'phone_fixed' => '(11) 1111-1111',
            'status' => 'A',
        ];
        
        $params = null;
        if($isNew){
            $params = [
                'unity' => $unityData,
                'address' => $addr
            ];
        }else{
            $address = Address::create($addr);
            $unityData['addr_id'] = $address->id;
            $unity = Unity::create($unityData);

            $params = [
                'unity' => $unity->toArray(),
                'address' => $address->toArray(),
            ];
        }

        return $params;
    }
}   
