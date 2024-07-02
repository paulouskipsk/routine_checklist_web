<?php

namespace Tests\App\Http\Controllers\Web;


use Tests\TestCase;

class AuthWebControllerTest extends TestCase {
    // use RefreshDatabase;

    public function testAuthenticateWebSuccess(): void {
        $params = ['login' => 'admin', 'password' =>'utfprgp@tsi'];
        $headers = [ 'Accept', 'application/json'];
        $response = $this->post('/authenticate',  $params, $headers);

        $response->assertStatus(302);
        $response->assertRedirectContains('home');
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testAuthenticateWebFail(): void {
        $params = ['login' => 'login_errado', 'password' =>'password_errado'];
        $headers = [
            'Accept', 'application/json', 
            'laravel_session' => $this->getCookie('admin', 'utfprgp@tsi')
        ];

        $response = $this->post('/authenticate',  $params, $headers);
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testLogoutWebSuccess(): void {
        $headers = [
            'Accept', 'application/json', 
            'laravel_session' => $this->getCookie('admin', 'utfprgp@tsi')
        ];
        $response = $this->get('/logout',  [], $headers);
        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }

    public function testLogoutWebFail(): void {
        $headers = ['Accept', 'application/json'];
        $response = $this->post('/authenticate',  [], $headers);

        $response->assertStatus(302);
        $response->assertRedirectContains('/');
    }
}
