<?php

namespace Tests\App\Http\Controllers\Web;

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
        $this->testUrlFailNotLogged('/setor/listar');
    }

    public function testNewSuccessLogged(): void {
        $response = $this->get('/setor/novo', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.sector.new');
        $response->assertSeeTextInOrder(['Home', 'Listar Setores', 'Novo']);
        $response->assertSeeText('Salvar');
    }

    public function testNewFailNotLogged(): void {
        $this->testUrlFailNotLogged('/setor/novo');
    }

    public function testStoreFailNotLogged(): void {
        $params = ['description' => 'Setor '.uniqid(), 'status' => 'A'];
        $this->testUrlFailNotLogged('/setor/salvar', 'post', $params);
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
        $this->testUrlFailNotLogged('/setor/editar/'.$sector->id);
    }

    public function testUpdateFailNotLogged(): void {
        $params = Sector::first()->toArray();
        $params['description'] = 'Setor '.uniqid();
        $this->testUrlFailNotLogged('/setor/atualizar/'.$params['id'],'put', $params);
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
        $this->testUrlFailNotLogged('/setor/delete/'.$sector->id);
    }
}   
