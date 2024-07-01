<?php

namespace Tests\App\Http\Controllers\Api;

use App\Models\Sector;
use App\Models\User;
use App\Utils\Functions;
use Tests\TestCase;

class UserControllerTest extends TestCase {

    public function testIndexSuccessLogged(): void {
        $headers = $this->getHeaderWEB();
        $response = $this->get('/usuario/listar', $headers);
        $response->assertStatus(200);
        $response->assertViewIs('registrations.user.list');
        $response->assertSeeText('Listar Usuários');
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testIndexFailNotLogged(): void {
        $response = $this->get('/usuario/listar');
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testNewSuccessLogged(): void {
        $response = $this->get('/usuario/novo', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.user.new');
        $response->assertSeeTextInOrder(['Home', 'Listar Usuários', 'Novo']);
        $response->assertSeeText('Salvar');
    }

    public function testNewFailNotLogged(): void {
        $response = $this->get('/usuario/novo');
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testStoreFailNotLogged(): void {
        $params = [
            'description' => 'Usuário '.uniqid(),
            'status' => 'A'
        ];
        $response = $this->post('/usuario/salvar/', $params);
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testStoreSuccess(): void {
        $params = $this->getUserParams(true);
        $response = $this->post('/usuario/salvar/', $params, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertRedirectContains('/usuario/novo');
        $response->assertSessionHas('flash-success-msg', 'Usuário cadastrado com sucesso.');
    }

    public function testEditSuccessLogged(): void {
        $response = $this->get('/usuario/editar/1', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.user.edit');
        $response->assertSeeTextInOrder(['Home', 'Listar Usuários', 'Editar']);
        $response->assertSeeText('Salvar');
    }
    public function testEditFailNotLogged(): void {
        $user = Sector::first();
        $response = $this->get('/usuario/editar/'.$user->id);
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testUpdateFailNotLogged(): void {
        $params = $this->getUserParams(false);
        $params['name'] = 'Usuário '.uniqid();
        $response = $this->put('/usuario/atualizar/'.$params['id'], $params);
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }
    public function testUpdateSuccess(): void {
        $user = Sector::first()->toArray();
        $user['name'] = 'User '.uniqid();
        $headers = $this->getHeaderWEB();
        $response = $this->put('/usuario/atualizar/'.$user['id'], $user, $headers);
        $response->assertStatus(302);
        $response->assertRedirectContains('/usuario/listar');
        $response->assertSessionHas('flash-success-msg', 'Usuário atualizado com sucesso.');
    }

    private function getUserParams(bool $isNew){
        $user = User::where('name', 'UserTest')->first();
        if(!Functions::nullOrEmpty($user)) $user->delete();

        $user = [
            'name' => 'UserTest',
            'lastname' => 'LastNameTest',
            'email' => '',
            'login' =>'usertest',
            'password' => '123456',
            'status' => 'A',
            'access_admin' => 'N',
            'access_operator' => 'N',
            'access_mobile' => 'S',
        ];

        if(!$isNew){
            $user = User::create($user);
            $user = $user->toArray();
        }

        return $user;
    }
}   
