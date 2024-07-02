<?php

namespace Tests\App\Http\Controllers\Web;

use App\Models\Checklist;
use App\Models\ChecklistItem;
use App\Models\Unity;
use App\Models\UsersGroup;
use App\Utils\Functions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChecklistControllerTest extends TestCase {
    

    public function testIndexFailNotLogged(): void {
        $this->testUrlFailNotLogged('/checklist/listar');
    }
    public function testIndexSuccessLogged(): void {
        $response = $this->get('/checklist/listar', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.checklist.list');
        $response->assertSeeText('Listar Checklists');
        $response->assertSeeTextInOrder(['Home', 'Listar Checklists']);
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testCreateFailNotLogged(): void {
        $this->testUrlFailNotLogged('/checklist/novo');
    }
    public function testCreateSuccessLogged(): void {
        $response = $this->get('/checklist/novo', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.checklist.new');
        $response->assertSeeTextInOrder(['Home', 'Listar Checklists', 'Novo']);
        $response->assertSeeText('Salvar');
    }

    public function testStoreFailNotLogged(): void {
        $params = $this->getChecklistParams(true);
        $this->testUrlFailNotLogged('/checklist/salvar', 'post', $params);
    }

    public function testStoreSuccess(): void {
        $params = $this->getChecklistParams(true);
        $response = $this->post('/checklist/salvar/', $params, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertRedirectContains('/checklist-item/novo/checklist/');
        $response->assertSessionHas('flash-success-msg', 'Checklist cadastrado com sucesso.');
    }

    public function testEditSuccessLogged(): void {
        $params = $this->getChecklistParams(false);
        $response = $this->get('/checklist/editar/'.$params['id'], $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.checklist.edit');
        $response->assertSeeTextInOrder(['Home', 'Listar Checklists', 'Editar']);
        $response->assertSeeText('Editar Checklist');
        $response->assertSeeText('Salvar');
    }
    public function testEditFailNotLogged(): void {
        $params = $this->getChecklistParams(false);
        $this->testUrlFailNotLogged('/checklist/editar/'.$params['id']);
    }

    public function testUpdateFailNotLogged(): void {
        $params = $this->getChecklistParams(false);
        $this->testUrlFailNotLogged('/checklist/atualizar/'.$params['id'], 'put', $params);
    }

    public function testUpdateSuccess(): void {
        $params = $this->getChecklistParams(false);
        $response = $this->put('/checklist/atualizar/'.$params['id'], $params, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertRedirectContains('/checklist/listar');
        $response->assertSessionHas('flash-success-msg', 'Checklist atualizado com sucesso.');
    }

    public function testDeleteFailNotLogged(): void {
        $params = $this->getChecklistParams(false);
        $this->testUrlFailNotLogged('/checklist/delete/'.$params['id'], 'get', $params);
    }

    public function testDeleteSuccess(): void {
        $params = $this->getChecklistParams(false);
        $response = $this->get('/checklist/delete/'.$params['id'], $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertRedirectContains('/checklist/listar');
        $response->assertSessionHas('flash-success-msg', 'Checklist deletado com sucesso.');
    }

    public function testGenerateTasksFailNotLogged(): void {
        $params = $this->getChecklistParams(false);
        $payload = [
            'units'=>Unity::all()->pluck('id'),
            'checklistId'=>$params['id']
        ];
        $this->testUrlFailNotLogged('/checklist/gerar-tarefa/', 'post', $payload);
    }
    public function testGenerateTasksSuccess(): void {
        $params = $this->getChecklistParams(false);
        $payload = [
            'units'=>Unity::all()->pluck('id'),
            'checklistId'=>$params['id']
        ];
        $response = $this->postJson('/checklist/gerar-tarefa/', $payload, $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertJson([
            "status" => true,
            "status_code" => 200,
            "payload" => [],
            "errors" => []
        ]);
        $this->assertTrue(preg_match("/Tarefas para o checklist \d+, geradas com sucesso\./", $response->json('message')) === 1);
    }

    private function getChecklistParams(bool $isNew){
        $checklist = Checklist::where('description', 'Checklist Test')->first();
        if(!Functions::nullOrEmpty($checklist)) $checklist->delete();

        $checklistParam =[
            'description' => 'Checklist Test',
            'generate_time' => '00:00:00',
            'shelflife' => 30,
            'frequency' => 'D',
            'frequency_composition' => [],
            'status' => 'A',
            'chkl_type' => 'N',
            'changed_by_user' => 1,
            'chcl_id' => null
        ];
        if(!$isNew){
            $checklist = Checklist::create($checklistParam);
            $checklist->units()->sync(Unity::all());
            $checklist->usersGroups()->sync(UsersGroup::get());

            ChecklistItem::create([
                'description' => 'Um Pergunta Teste',
                'sequence' => 1,
                'score' => 1,
                'status' => 'A',
                'type' => 'S',
                'hour_min' => '00:00',
                'hour_max' => '23:59',
                'shelflife' => 24,
                'required_photo' => 'N',
                'quant_photo' => 1,
                'changed_by_user' => 1,
                'type_obs' => 'N',
                'sect_id' => null,
                'chkl_id' => $checklist->id
            ]);

            $checklistParam = $checklist->toArray();
        } 
        return $checklistParam;
     }
    
}   
