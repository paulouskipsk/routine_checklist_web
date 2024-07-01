<?php

namespace Tests\App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthApiControllerTest extends TestCase {
    // use RefreshDatabase;

    public function testGetForUserUnitsNotAuthenticatedSuccess(): void {
        $params = ['login' => 'admin', 'password' =>'utfprgp@tsi', 'unity' => 0];
        $headers = [ 'Accept', 'application/json'];
        $response = $this->post('/api/auth/user-data-by-credentials',  $params, $headers);

        $response->assertStatus(200);
        $response->assertJsonIsObject();
        $this->assertTrue(str_contains($response['message'], 'Usuário recuperado com sucesso'));
        $this->assertTrue(!empty($response['payload']['user']));
        $this->assertTrue( $response['payload']['units'] !== null);
        $response->assertJson(["status" => true,"status_code" => 200]);
    }

    public function testGetForUserUnitsNotAuthenticatedError(): void {
        $params = ['login' => 'admin', 'password' =>'wrongPassword', 'unity' => 0];
        $headers = [ 'Accept', 'application/json'];
        $response = $this->post('/api/auth/user-data-by-credentials',  $params, $headers);

        $response->assertStatus(401);
        $response->assertJsonIsObject();
        $this->assertTrue(str_contains($response['message'], 'Login ou senha não conferem'));
        $this->assertTrue(empty($response['payload']));
        $this->assertTrue( empty($response['errors']));
        $response->assertJson(["status" => false,"status_code" => 401]);
    }

    public function testApiAutenticationUserSuccess(): void {
        $params = ['login' => 'admin', 'password' =>'utfprgp@tsi', 'unity' => 1];
        $headers = [ 'Accept', 'application/json'];
        $response = $this->post('/api/auth/authenticate',  $params, $headers);

        $response->assertJsonIsObject();
        $this->assertTrue(str_contains($response['message'], 'Seja bem vindo, '));
        $this->assertTrue(!empty($response['payload']['token']));
        $this->assertTrue(empty($response['errors']));
        $response->assertJson(["status" => true, "status_code" => 200]);
    }

    public function testAutenticationUserFailForLoginOrPasswordIncorrect(): void {
        $params = ['login' => 'admin', 'password' =>'senha_errada'];
        $headers = [ 'Accept', 'application/json'];
        $response = $this->post('/api/auth/authenticate',  $params, $headers);

        $response->assertStatus(401);
        $response->assertJsonIsObject();
        $this->assertTrue(str_contains($response['message'], 'Login ou senha não conferem'));
        $this->assertTrue(empty($response['payload']));
        $this->assertTrue(empty($response['errors']));
        $response->assertJson(["status" => false,"status_code" => 401]);
    }

    public function testGetUserAuthenticatedSuccess(): void {
        $response = $this->get('/api/auth/user', $this->getHeaderAPI());
        $response->assertStatus(200);
        $response->assertJsonIsObject();
        $this->assertTrue(str_contains($response['message'], 'Usuário autenticado recuperado com sucesso.'));
        $this->assertTrue(!empty($response['payload']['user']));
        $this->assertTrue(empty($response['errors']));
        $response->assertJson(["status" => true,"status_code" => 200]);
    }

    public function testGetUserAuthenticatedFail(): void {
        $response = $this->get('/api/auth/user', ['Authorization' => "Bearer enviando_token_invalido"]);
        $response->assertStatus(302);
        $response->assertRedirectContains('login');
    }

    public function testLogoutWithUserSuccess(): void {
        $user = User::where('login', 'admin')->first();
        $response = $this->get('/api/auth/logout', $this->getHeaderAPI());
        $response->assertStatus(200);
        $this->assertTrue(str_contains($response['message'], 'Usuário deslogado com sucesso.'));
        $response->assertStatus(200);
        $response->assertJsonIsObject();
        $response->assertJson(["status" => true,"status_code" => 200]);
    }

    public function testLogoutWithoutUserError(): void {
        $response = $this->get('/api/auth/logout');
        $response->assertStatus(302);
    }
}