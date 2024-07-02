<?php

namespace Tests\App\Http\Controllers\Api;

use App\Models\ChecklistMov;
use Tests\TestCase;

class ChecklistMovControllerApiTest extends TestCase {

    // public function testGetChecklistMovByIdWithItensSuccess(): void {
    //     $params = ['login' => 'admin', 'password' =>'utfprgp@tsi', 'unity' => 0];

    //     $movId = ChecklistMov::first()->id;
    //     $response = $this->post('/api/checklistmov/with-itens/'.$movId, $this->getHeaderAPI());

    //     $response->assertStatus(200);
    //     $response->assertJsonIsObject();
    //     $this->assertTrue(str_contains($response['message'], 'Usuário recuperado com sucesso'));
    //     $this->assertTrue(!empty($response['payload']['user']));
    //     $this->assertTrue( $response['payload']['units'] !== null);
    //     $response->assertJson(["status" => true,"status_code" => 200]);
    // }
}