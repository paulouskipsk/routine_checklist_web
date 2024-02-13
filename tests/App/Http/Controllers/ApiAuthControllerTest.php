<?php

namespace Tests\App\Http\Controllers;

use Tests\TestCase;

class ApiAuthControllerTest extends TestCase {

    public function testAutenticationUserSuccess(): void {
        $params = ['login' => 'admin', 'password' =>'123'];
        $headers = [ 'Accept', 'application/json'];
        $response = $this->post('/api/auth/authenticate',  $params, $headers);

        $response->assertStatus(200);
        $response->assertJsonIsObject();
        $this->assertTrue(str_contains($response['message'], 'Seja bem vindo, '));
        $this->assertTrue(!empty($response['payload']['token']));
        $this->assertTrue(empty($response['errors']));
        $response->assertJson(["status" => true,"status-code" => 200]);
        $response->assertOk();
    }

    public function testAAutenticationUserFailForLoginOrPasswordIncorrect(): void {
        $params = ['login' => 'admin', 'password' =>'senha_errada'];
        $headers = [ 'Accept', 'application/json'];
        $response = $this->post('/api/auth/authenticate',  $params, $headers);

        $response->assertStatus(401);
        $response->assertJsonIsObject();
        $this->assertTrue(str_contains($response['message'], 'Login ou senha não conferem'));
        $this->assertTrue(empty($response['payload']));
        $this->assertTrue(empty($response['errors']));
        $response->assertJson(["status" => false,"status-code" => 401]);
        $response->assertUnauthorized();
    }

    public function testGetUserAuthenticatedSuccess(): void {
        $response = $this->get('/api/auth/user', $this->getHeader());
        $response->assertStatus(200);
        $response->assertJsonIsObject();
        $this->assertTrue(str_contains($response['message'], 'Usuário autenticado recuperado com sucesso.'));
        $this->assertTrue(!empty($response['payload']['user']));
        $this->assertTrue(empty($response['errors']));
        $response->assertJson(["status" => true,"status-code" => 200]);
        $response->assertOk();
    }

    public function testGetUserAuthenticatedFail(): void {
        $response = $this->get('/api/auth/user', ['Authorization' => "Bearer enviando_token_invalido"]);
        $response->assertStatus(302);
        $response->assertRedirectContains('login');
    }
}