<?php

namespace Tests\App\Http\Controllers\Web;

use App\Models\User;
use App\Models\UsersGroup;
use App\Utils\Functions;
use Tests\TestCase;

class UsersGroupControllerTest extends TestCase {

    public function testIndexSuccessLogged(): void {
        $response = $this->get('/grupo-usuarios/listar', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.user-group.list');
        $response->assertSeeText('Listar Gr. Usuários');
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testIndexFailNotLogged(): void {
        $this->testUrlFailNotLogged('/grupo-usuarios/listar');
    }

    public function testNewSuccessLogged(): void {
        $response = $this->get('/grupo-usuarios/novo', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.user-group.new');
        $response->assertSeeTextInOrder(['Home', 'Listar Gr. Usuários', 'Novo']);
        $response->assertSeeText('Salvar');
    }

    public function testNewFailNotLogged(): void {
        $this->testUrlFailNotLogged('/grupo-usuarios/novo');
    }

    public function testStoreFailNotLogged(): void {
        $params = $this->getUserGroupsParams(true);
        $this->testUrlFailNotLogged('/grupo-usuarios/salvar', 'post', $params);
    }

    public function testStoreSuccess(): void {
        $params = $this->getUserGroupsParams(true);
        $response = $this->post('/grupo-usuarios/salvar/', $params, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertRedirectContains('/grupo-usuarios/novo');
        $response->assertSessionHas('flash-success-msg', 'Grupo de Usuários cadastrado com sucesso.');
    }

    public function testEditSuccessLogged(): void {
        $response = $this->get('/grupo-usuarios/editar/1', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.user-group.edit');
        $response->assertSeeText('Editar Grupo de Usuários');
        $response->assertSeeText('Salvar');
    }
    public function testEditFailNotLogged(): void {
        $params = $this->getUserGroupsParams(false);
        $this->testUrlFailNotLogged('/grupo-usuarios/editar/'.$params['id']);
    }

    public function testUpdateFailNotLogged(): void {
        $params = $this->getUserGroupsParams(false);
        $this->testUrlFailNotLogged('/grupo-usuarios/atualizar/'.$params['id'], 'put', $params);
    }
    public function testUpdateSuccess(): void {
        $params = $this->getUserGroupsParams(false);
        $params['name'] = 'UsersGroup '.uniqid();
        $response = $this->put('/grupo-usuarios/atualizar/'.$params['id'], $params, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertRedirectContains('/grupo-usuarios/listar');
        $response->assertSessionHas('flash-success-msg', 'Grupo de Usuários atualizado com sucesso.');
    }

    private function getUserGroupsParams(bool $isNew){
        $usersGroup = UsersGroup::where('name', 'Testing')->first();
        if(!Functions::nullOrEmpty($usersGroup)) $usersGroup->delete();
        $usersIds = User::all()->pluck('id')->implode(',');
        $usersGroup = [
            'name' => 'Testing',
            'status' => 'A'
        ];
        if(!$isNew){
            $usersGroup = UsersGroup::create($usersGroup);
            $usersGroup = $usersGroup->toArray();
        }
        $usersGroup['users_selecteds'] = $usersIds;
        return $usersGroup;
    }
}   
