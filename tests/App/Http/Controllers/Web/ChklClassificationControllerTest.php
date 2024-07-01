<?php

namespace Tests\App\Http\Controllers\Api;

use App\Models\ChklClassification;
use Carbon\Carbon;
use Tests\TestCase;

class ChklClassificationControllerTest extends TestCase {

    public function testIndexSuccessLogged(): void {
        $headers = $this->getHeaderWEB();
        $response = $this->get('/classificacao/listar', $headers);
        $response->assertStatus(200);
        $response->assertViewIs('registrations.classification.list');
        $response->assertSeeText('Listar Classificações');
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testIndexFailNotLogged(): void {
        $response = $this->get('/classificacao/listar');
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testNewSuccessLogged(): void {
        $response = $this->get('/classificacao/novo', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.classification.new');
        $response->assertSeeTextInOrder(['Home', 'Listar Classificações', 'Novo']);
        $response->assertSeeText('Salvar');
    }

    public function testNewFailNotLogged(): void {
        $response = $this->get('/classificacao/novo');
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testStoreFailNotLogged(): void {
        $params = [
            'description' => 'Classificação '.uniqid(),
            'status' => 'A'
        ];
        $response = $this->post('/classificacao/salvar/', $params);
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testStoreSuccess(): void {
        $params = [
            'description' => 'Classificação '.uniqid(),
            'status' => 'A'
        ];
        $response = $this->post('/classificacao/salvar/', $params, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertRedirectContains('/classificacao/novo');
        $response->assertSessionHas('flash-success-msg', 'Classificação cadastrada com sucesso.');
    }

    public function testEditSuccessLogged(): void {
        $response = $this->get('/classificacao/editar/1', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.classification.edit');
        $response->assertSeeTextInOrder(['Home', 'Listar Classificações', 'Editar']);
        $response->assertSeeText('Salvar');
    }
    public function testEditFailNotLogged(): void {
        $classification = ChklClassification::first();
        $response = $this->get('/classificacao/editar/'.$classification->id);
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testUpdateFailNotLogged(): void {
        $classification = ChklClassification::first()->toArray();
        $classification['description'] = 'Classificação '.uniqid();
        $response = $this->put('/classificacao/atualizar/'.$classification['id'], $classification);
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }
    public function testUpdateSuccess(): void {
        $classification = ChklClassification::first()->toArray();
        $classification['description'] = 'classification '.uniqid();
        $headers = $this->getHeaderWEB();
        $response = $this->put('/classificacao/atualizar/'.$classification['id'], $classification, $headers);
        $response->assertStatus(302);
        $response->assertRedirectContains('/classificacao/listar');
        $response->assertSessionHas('flash-success-msg', 'Classificação atualizada com sucesso.');
    }

    public function testDeleteSuccessLogged(): void {
        $classification = ChklClassification::first();
        $response = $this->get('/classificacao/delete/'.$classification->id, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertRedirectContains('classificacao/listar');
    }
    public function testDeleteFailNotLogged(): void {
        $classification = ChklClassification::first();
        $response = $this->get('/classificacao/delete/'.$classification->id);
        $response->assertStatus(302);
        $response->assertRedirectContains('/login');
    }
}   
