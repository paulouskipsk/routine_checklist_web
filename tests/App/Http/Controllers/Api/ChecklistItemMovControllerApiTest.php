<?php

namespace Tests\App\Http\Controllers\Api;

use App\Models\Checklist;
use App\Models\ChecklistItem;
use App\Models\ChecklistMov;
use App\Models\Unity;
use App\Models\UsersGroup;
use App\Services\ChecklistMovService;
use App\Utils\Functions;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ChecklistItemMovControllerApiTest extends TestCase {

    public function testGetChecklistsItensMovsSuccess(): void {
        $ichkl = $this->getChecklistParams();
        (new ChecklistMovService())->generateChecklistMov($ichkl->checklist, $ichkl->checklist->units);
        $count = ChecklistMov::where('chkl_id', $ichkl->chkl_id)->first()->checklistItensMovs->count();

        $url='/api/checklistitemmov/by-checklistmov?chmv_id='.$ichkl->chkl_id;
        $response = $this->getJson($url, $this->getHeaderAPI());
        $response->assertJsonPath('payload.checklistsItensMovs', fn ($checklistsItensMovs) => is_array($checklistsItensMovs));
        $response->assertJsonPath('payload.checklistsItensMovs', fn ($checklistsItensMovs) => sizeof($checklistsItensMovs) == $count);

        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('status', true)
            ->where('status_code', 200)
            ->where('errors', [])
            ->where('message', 'Perguntas do Checklist Pesquisados com sucesso.')
            ->where('payload', fn ($payload) => $payload !== null)
            ->etc()
        );    
    }

    public function testResponseChecklistItemMovSuccess(): void {
        $ichkl = $this->getChecklistParams();
        (new ChecklistMovService())->generateChecklistMov($ichkl->checklist, $ichkl->checklist->units);
        $question = ChecklistMov::where('chkl_id', $ichkl->chkl_id)->first()->checklistItensMovs->first();
        $question->response = 'S';
        $question->photos = ["Foto1"];
        $question->observation = 'Observação Teste '.rand(1000, 9999);
        $question->save();

        $response = $this->putJson('/api/checklistitemmov/'.$question->id, $question->toArray(), $this->getHeaderAPI());
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('status', true)
            ->where('status_code', 201)
            ->where('errors', [])
            ->where('message', "Todas as perguntas foram respondidas, Checklist finalizado, Parabéns!")
            ->where('payload', fn ($payload) => sizeof($payload) == 0)
            ->etc()
        );
    }

    public function testResponseChecklistItemMovWithoutResponseFail(): void {
        $ichkl = $this->getChecklistParams();
        (new ChecklistMovService())->generateChecklistMov($ichkl->checklist, $ichkl->checklist->units);
        $question = ChecklistMov::where('chkl_id', $ichkl->chkl_id)->first()->checklistItensMovs->first();
        $question->photos = ["Foto1"];
        $question->observation = 'Observação Teste '.rand(1000, 9999);
        $question->save();
        $response = $this->putJson('/api/checklistitemmov/'.$question->id, $question->toArray(), $this->getHeaderAPI());

        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('status', false)
            ->where('status_code', 400)
            ->where('message', fn($message) => preg_match("/Erro ao gravar resposta da pergunta \d+\./", $message) === 1)
            ->where('message', fn($message) => str_contains($message, "Campo 'response' n\\u00e3o informado."))
            ->where('payload', fn ($payload) => sizeof($payload) == 0)
            ->etc()
        );
    }

    public function testResponseChecklistItemMovWithoutPhotosFail(): void {
        $ichkl = $this->getChecklistParams();
        (new ChecklistMovService())->generateChecklistMov($ichkl->checklist, $ichkl->checklist->units);
        $question = ChecklistMov::where('chkl_id', $ichkl->chkl_id)->first()->checklistItensMovs->first();
        $question->response = 'S';
        $question->observation = 'Observação Teste '.rand(1000, 9999);
        $question->save();
        $response = $this->putJson('/api/checklistitemmov/'.$question->id, $question->toArray(), $this->getHeaderAPI());

        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('status', false)
            ->where('status_code', 400)
            ->where('message', fn($message) => preg_match("/Erro ao gravar resposta da pergunta \d+\./", $message) === 1)
            ->where('message', fn($message) => str_contains($message, "Campo 'photos' n\\u00e3o informado."))
            ->where('payload', fn ($payload) => sizeof($payload) == 0)
            ->etc()
        );
    }

    public function testResponseChecklistItemMovWithoutObservationFail(): void {
        $ichkl = $this->getChecklistParams();
        (new ChecklistMovService())->generateChecklistMov($ichkl->checklist, $ichkl->checklist->units);
        $question = ChecklistMov::where('chkl_id', $ichkl->chkl_id)->first()->checklistItensMovs->first();
        $question->response = 'S';
        $question->photos = ["Foto1"];
        $question->save();
        $response = $this->putJson('/api/checklistitemmov/'.$question->id, $question->toArray(), $this->getHeaderAPI());

        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('status', false)
            ->where('status_code', 400)
            ->where('message', fn($message) => preg_match("/Erro ao gravar resposta da pergunta \d+\./", $message) === 1)
            ->where('message', fn($message) => str_contains($message, "Campo 'observation' n\\u00e3o informado."))
            ->where('payload', fn ($payload) => sizeof($payload) == 0)
            ->etc()
        );
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

        $checklistItem = ChecklistItem::create([
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

        return $checklistItem;
     }
}