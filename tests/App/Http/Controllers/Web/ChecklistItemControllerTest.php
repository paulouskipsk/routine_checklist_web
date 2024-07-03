<?php

namespace Tests\App\Http\Controllers\Web;

use App\Models\Checklist;
use App\Models\ChecklistItem;
use App\Models\Unity;
use App\Models\UsersGroup;
use App\Utils\Functions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChecklistItemControllerTest extends TestCase {
    

    public function testIndexFailNotLogged(): void {
        $params = $this->getChecklistParams(false);
        $this->testUrlFailNotLogged('/checklist-item/listar/checklist/'.$params['chkl_id']);
    }
    public function testIndexSuccessLogged(): void {
        $params = $this->getChecklistParams(false);
        $response = $this->get('/checklist-item/listar/checklist/'.$params['chkl_id'], $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.checklist-item.list');
        $response->assertSeeText('Listar Perguntas do checklist');
        $response->assertSeeTextInOrder(['Home', 'Listar Pergunta do Checklist']);
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testCreateFailNotLogged(): void {
        $params = $this->getChecklistParams(false);
        $this->testUrlFailNotLogged('/checklist-item/novo/checklist/'.$params['chkl_id']);
    }
    public function testCreateSuccessLogged(): void {
        $params = $this->getChecklistParams(false);
        $response = $this->get('/checklist-item/novo/checklist/'.$params['chkl_id'], $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.checklist-item.new');
        $response->assertSee('Nova Pergunta do Checklist');
        $response->assertSeeTextInOrder(['Home', 'Listar Perguntas do Checklist', 'Novo']);
        $response->assertSeeText('Salvar');
    }

    public function testStoreFailNotLogged(): void {
        $params = $this->getChecklistParams(true);
        $this->testUrlFailNotLogged('/checklist-item/salvar', 'post', $params);
    }

    public function testStoreSuccess(): void {
        $params = $this->getChecklistParams(true);
        $response = $this->post('/checklist-item/salvar', $params, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertRedirectContains('/checklist-item/listar/checklist/'.$params['chkl_id']);
        $response->assertSessionHas('flash-success-msg', 'Pergunta cadastrada com sucesso.');
    }

    public function testEditFailNotLogged(): void {
        $params = $this->getChecklistParams(false);
        $this->testUrlFailNotLogged('/checklist-item/editar/'.$params['id']);
    }
    
    public function testEditSuccessLogged(): void {
        $params = $this->getChecklistParams(false);
        $response = $this->get('/checklist-item/editar/'.$params['id'], $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('registrations.checklist-item.edit');
        $response->assertSeeTextInOrder(['Home', 'Listar Perguntas do Checklist', 'Editar']);
        $response->assertSeeText('Editar Pergunta Checklist');
        $response->assertSeeText('Salvar');
    }


    public function testUpdateFailNotLogged(): void {
        $params = $this->getChecklistParams(false);
        $this->testUrlFailNotLogged('/checklist-item/atualizar/'.$params['id'], 'put', $params);
    }

    public function testUpdateSuccess(): void {
        $params = $this->getChecklistParams(false);
        $response = $this->put('/checklist-item/atualizar/'.$params['id'], $params, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertRedirectContains('/checklist-item/listar');
        $response->assertSessionHas('flash-success-msg', 'Pergunta atualizada com sucesso.');
    }

    public function testDeleteFailNotLogged(): void {
        $params = $this->getChecklistParams(false);
        $this->testUrlFailNotLogged('/checklist-item/delete/'.$params['id'], 'get', $params);
    }

    public function testDeleteSuccess(): void {
        $params = $this->getChecklistParams(false);
        $response = $this->get('/checklist-item/delete/'.$params['id'], $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertRedirectContains('/checklist-item/listar');
        $response->assertSessionHas('flash-success-msg', function($value) {
            return preg_match("/Pergunta\s'\d+'\sdeletada com sucesso\./", $value) === 1;
        });
    }

    private function getChecklistParams(bool $isNew){
        $checklist = Checklist::where('description', 'Checklist Test')->first();
        if(!Functions::nullOrEmpty($checklist)) $checklist->delete();

        $checklist = Checklist::create([
            'description' => 'Checklist Test',
            'generate_time' => '00:00:00',
            'shelflife' => 30,
            'frequency' => 'D',
            'frequency_composition' => [],
            'status' => 'A',
            'chkl_type' => 'N',
            'changed_by_user' => 1,
            'chcl_id' => null
        ]);
        $checklist->units()->sync(Unity::all());
        $checklist->usersGroups()->sync(UsersGroup::get());

        $param = [
            'description' => 'Uma Pergunta Teste '.rand(1000, 9999),
            'sequence' => ChecklistItem::max('sequence') + 1,
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
        ];

        if(!$isNew){
            $checklistItem = ChecklistItem::create($param);
            $param = $checklistItem->toArray();
        } 
        return $param;
     }
    
}   
