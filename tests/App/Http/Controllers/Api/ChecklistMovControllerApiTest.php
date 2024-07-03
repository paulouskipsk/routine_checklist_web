<?php

namespace Tests\App\Http\Controllers\Api;

use Tests\TestCase;
use App\Models\Unity;
use App\Utils\Functions;
use App\Models\Checklist;
use App\Models\UsersGroup;
use App\Models\ChecklistMov;
use App\Models\ChecklistItem;
use App\Services\ChecklistMovService;
use Illuminate\Testing\Fluent\AssertableJson;

class ChecklistMovControllerApiTest extends TestCase {

    // public function testGetChecklistMovByIdWithItensSuccess(): void {
    //     $checklistMov = $this->getChecklistParams();
    //     $header = $this->getHeaderAPI();
    //     $response = $this->putJson('/api/checklistmov/associate-checklistmov', ['checklistMovId'=>$checklistMov->id], $header);
    //     $response = $this->getJson('/api/checklistmov/by-user', $header);

    //     $response->assertStatus(200);
    //     $response->assertJsonPath('payload.checklistMov.checklist_itens_movs', fn ($checklistsItensMovs) => is_array($checklistsItensMovs));
    //     $response->assertJson(fn (AssertableJson $json) => $json
    //         ->where('status', true)
    //         ->where('status_code', 200)
    //         ->where('message', 'Tarefa de Checklist Pesquisado com sucesso.')
    //         ->where('payload', fn ($payload) => sizeof($payload) > 0)
    //         ->etc()
    //     );
    //     $response->assertJsonStructure([
    //         "status",
    //         "status_code",
    //         "message",
    //         "payload" => [
    //             "checklistMov" => [
    //                 "checklist_itens_movs" => []
    //             ]
    //         ],
    //         "errors" => []
    //     ]);
    // }

    public function testGetChecklistMovByIdWithItensSuccess(): void {
        $checklistMov = $this->getChecklistParams();
        $response = $this->getJson('/api/checklistmov/with-itens/'.$checklistMov->id, $this->getHeaderAPI());

        $response->assertStatus(200);
        $response->assertJsonPath('payload.checklistMov.checklist_itens_movs', fn ($checklistsItensMovs) => is_array($checklistsItensMovs));
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('status', true)
            ->where('status_code', 200)
            ->where('message', 'Tarefa de Checklist Pesquisado com sucesso.')
            ->where('payload', fn ($payload) => sizeof($payload) > 0)
            ->etc()
        );
        $response->assertJsonStructure([
            "status",
            "status_code",
            "message",
            "payload" => [
                "checklistMov" => [
                    "checklist_itens_movs" => []
                ]
            ],
            "errors" => []
        ]);
    }

    public function testAssociateChecklistMovWithUserLoggedSuccess(): void {
        $checklistMov = $this->getChecklistParams();
        $response = $this->putJson('/api/checklistmov/associate-checklistmov', ['checklistMovId'=>$checklistMov->id],$this->getHeaderAPI());

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('status', true)
            ->where('status_code', 200)
            ->where('message', fn($message)=> preg_match("/Checklist Associado ao usuário '.*?'\s\scom sucesso\./", $message) == 1)
            ->where('payload', fn ($payload) => sizeof($payload) > 0)
            ->etc()
        );
        $response->assertJsonStructure([
            "status",
            "status_code",
            "message",
            "payload" => [
                "checklistMov" => []
            ],
            "errors" => []
        ]);
    }

    public function testDisassociateChecklistMovLoggedSuccess(): void {
        $checklistMov = $this->getChecklistParams();
        $response = $this->putJson('/api/checklistmov/disassociate-checklistmov', ['checklistMovId'=>$checklistMov->id],$this->getHeaderAPI());

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('status', true)
            ->where('status_code', 200)
            ->where('message', 'Checklist liberado com sucesso.')
            ->where('payload', fn ($payload) => sizeof($payload) > 0)
            ->etc()
        );
        $response->assertJsonStructure([
            "status",
            "status_code",
            "message",
            "payload" => [
                "checklistMov" => []
            ],
            "errors" => []
        ]);
    }

    public function testFinishChecklistMovLoggedSuccess(): void {
        $checklistMov = $this->getChecklistParams();
        $response = $this->putJson('/api/checklistmov/finish', ['checklist_id'=>$checklistMov->id],$this->getHeaderAPI());

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('status', true)
            ->where('status_code', 200)
            ->where('message', 'Checklist Finalizado com sucesso.')
            ->where('payload', fn ($payload) => sizeof($payload) == 0)
            ->etc()
        );
        $response->assertJsonStructure([
            "status",
            "status_code",
            "message",
            "payload" => [],
            "errors" => []
        ]);
    }

    private function getChecklistParams(){
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

        ChecklistItem::create([
            'description' => 'Uma Pergunta Teste '.rand(1000, 9999),
            'sequence' => ChecklistItem::max('sequence') + 1,
            'score' => 1,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '23:59',
            'shelflife' => 24,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'type_obs' => 'R',//required
            'sect_id' => null,
            'chkl_id' => $checklist->id
        ]);

        (new ChecklistMovService())->generateChecklistMov($checklist, $checklist->units);
        $checklistMov = ChecklistMov::where('chkl_id', $checklist->id)->first();
        return $checklistMov;
     }
}