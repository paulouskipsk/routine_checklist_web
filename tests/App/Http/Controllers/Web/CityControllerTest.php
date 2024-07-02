<?php

namespace Tests\App\Http\Controllers\Web;

use Tests\TestCase;

class CityControllerTest extends TestCase {

    public function testGetCitiesByNameSuccessLogged(): void {
        $headers = $this->getHeaderWEB();
        $response = $this->get('/cidade/buscar-por-nome?search=guarapuava', $headers);
        $response->assertStatus(200);
        $response->assertSeeTextInOrder(['code',':4109401']);
        $response->assertSeeTextInOrder(['name','Guarapuava']);
    }

    public function testgetCitiesByNameFailNotLogged(): void {
        $this->testUrlFailNotLogged('/cidade/buscar-por-nome?search=guarapuava');
    }
}   
