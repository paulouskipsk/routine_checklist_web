<?php

namespace Tests\App\Http\Controllers\Web;

use Tests\TestCase;

class HomeControllerTest extends TestCase {

    public function testIndexSuccessLogged(): void {
        $headers = $this->getHeaderWEB();
        $response = $this->get('/home', $headers);
        $response->assertStatus(200);
        $response->assertViewIs('home');
        $response->assertSeeText('Resumo de execução dos checklists finalizados');
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testIndexFailNotLogged(): void {
        $this->testUrlFailNotLogged('/home');
    }
}   
