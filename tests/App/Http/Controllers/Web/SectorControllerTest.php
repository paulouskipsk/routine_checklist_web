<?php

namespace Tests\App\Http\Controllers\Api;

use App\Models\Sector;
use Carbon\Carbon;
use Tests\TestCase;

class SectorControllerTest extends TestCase {

    public function testIndexSuccessLogged(): void {
        $headers = $this->getHeaderWEB();
        $response = $this->get('/setor/listar', $headers);
        $response->assertStatus(200);
        $response->assertViewIs('registrations.sector.list');
        $response->assertSeeText('Listar Setores');
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testIndexFailNotLogged(): void {
        $response = $this->get('/setor/listar');
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testNewSuccessLogged(): void {
        $response = $this->get('/setor/novo', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.sector.new');
        $response->assertSeeTextInOrder(['Home', 'Listar Setores', 'Novo']);
        $response->assertSeeText('Salvar');
    }

    public function testNewFailNotLogged(): void {
        $response = $this->get('/setor/novo');
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testStoreFailNotLogged(): void {
        $params = [
            'description' => 'Setor '.uniqid(),
            'status' => 'A'
        ];
        $response = $this->post('/setor/salvar/', $params);
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testStoreSuccess(): void {
        $params = [
            'description' => 'Setor '.uniqid(),
            'status' => 'A'
        ];
        $response = $this->post('/setor/salvar/', $params, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertRedirectContains('/setor/novo');
        $response->assertSessionHas('flash-success-msg', 'Setor cadastrado com sucesso.');
    }

    public function testEditSuccessLogged(): void {
        $response = $this->get('/setor/editar/1', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.sector.edit');
        $response->assertSeeTextInOrder(['Home', 'Listar Setores', 'Editar']);
        $response->assertSeeText('Salvar');
    }
    public function testEditFailNotLogged(): void {
        $sector = Sector::first();
        $response = $this->get('/setor/editar/'.$sector->id);
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testUpdateFailNotLogged(): void {
        $sector = Sector::first()->toArray();
        $sector['description'] = 'Setor '.uniqid();
        $response = $this->put('/setor/atualizar/'.$sector['id'], $sector);
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }
    public function testUpdateSuccess(): void {
        $sector = Sector::first()->toArray();
        $sector['description'] = 'Setor '.uniqid();
        $headers = $this->getHeaderWEB();
        $response = $this->put('/setor/atualizar/'.$sector['id'], $sector, $headers);
        $response->assertStatus(302);
        $response->assertRedirectContains('/setor/listar');
        $response->assertSessionHas('flash-success-msg', 'Setor atualizado com sucesso.');
    }

    public function testDeleteSuccessLogged(): void {
        $sector = Sector::first();
        $response = $this->get('/setor/delete/'.$sector->id, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertRedirectContains('setor/listar');
    }
    public function testDeleteFailNotLogged(): void {
        $sector = Sector::first();
        $response = $this->get('/setor/delete/'.$sector->id);
        $response->assertStatus(302);
        $response->assertRedirectContains('/login');
    }
}   
