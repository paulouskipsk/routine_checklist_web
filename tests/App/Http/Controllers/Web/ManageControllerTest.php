<?php

namespace Tests\App\Http\Controllers\Web;

use App\Enums\Status;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use App\Models\ChecklistMov;
use App\Models\Unity;
use App\Models\UsersGroup;
use App\Services\ChecklistMovService;

use Tests\TestCase;

class ManageControllerTest extends TestCase {

    public function testIndexSuccessLogged(): void {
        $response = $this->get('/gerenciar/tarefas/listar', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('manage.tasks.list');
        $response->assertSeeText('Gerenciar Tarefas de Checklists');
        $response->assertSeeTextInOrder(['Home', 'Gerenciar Tarefas']);
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testIndexFailNotLogged(): void {
        $this->testUrlFailNotLogged('/gerenciar/tarefas/listar');
    }

    public function testGetPdfTaskActiveSuccessLogged(): void {
        $movId = $this->getTaskId(Status::ACTIVE);
        $response = $this->get('/gerenciar/get-report-task/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertSeeText('%PDF');
        $response->assertHeader('Content-Type','application/pdf');
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testGetPdfTaskCanceledSuccessLogged(): void {
        $movId = $this->getTaskId(Status::CANCELED);
        $response = $this->get('/gerenciar/get-report-task/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertSeeText('%PDF');
        $response->assertHeader('Content-Type','application/pdf');
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testGetPdfTaskClosedSuccessLogged(): void {
        $movId = $this->getTaskId(Status::CLOSED);
        $response = $this->get('/gerenciar/get-report-task/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertSeeText('%PDF');
        $response->assertHeader('Content-Type','application/pdf');
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testGetPdfTaskClosedBySystemSuccessLogged(): void {
        $movId = $this->getTaskId(Status::CLOSED_BY_SYSTEM);
        $response = $this->get('/gerenciar/get-report-task/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertSeeText('%PDF');
        $response->assertHeader('Content-Type','application/pdf');
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testGetPdfFailNotLogged(): void {
        $movId = $this->getTaskId(Status::ACTIVE);
        $this->testUrlFailNotLogged('/gerenciar/get-report-task/'.$movId);
    }

    public function testGetAppDownloadSuccessLogged(): void {
        $response = $this->get('/app/download', $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertNoContent(200);
        $response->assertDownload('routine_checklist.apk');
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testGetAppDownloadSuccessNotLogged(): void {
        $response = $this->get('/app/download');
        $response->assertStatus(200);
        $response->assertNoContent(200);
        $response->assertDownload('routine_checklist.apk');
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testViewFailNotLogged(): void {
        $movId = $this->getTaskId(Status::ACTIVE);
        $this->testUrlFailNotLogged('/gerenciar/visualizar-tarefa/'.$movId);
    }
    public function testViewTaskActiveSuccessLogged(): void {
        $movId = $this->getTaskId(Status::ACTIVE);
        $response = $this->get('/gerenciar/visualizar-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('reports-views.view-movement');
        $response->assertSeeTextInOrder(['Estatísticas e Pontuações', 'Geral', 'Perguntas e Respostas']);
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testViewTaskCanceledSuccessLogged(): void {
        $movId = $this->getTaskId(Status::CANCELED);
        $response = $this->get('/gerenciar/visualizar-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('reports-views.view-movement');
        $response->assertSeeTextInOrder(['Estatísticas e Pontuações', 'Geral', 'Perguntas e Respostas']);
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testViewTaskClosedSuccessLogged(): void {
        $movId = $this->getTaskId(Status::CLOSED);
        $response = $this->get('/gerenciar/visualizar-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('reports-views.view-movement');
        $response->assertSeeTextInOrder(['Estatísticas e Pontuações', 'Geral', 'Perguntas e Respostas']);
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testViewTaskClosedBySystemSuccessLogged(): void {
        $movId = $this->getTaskId(Status::CLOSED_BY_SYSTEM);
        $response = $this->get('/gerenciar/visualizar-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(200);
        $response->assertViewIs('reports-views.view-movement');
        $response->assertSeeTextInOrder(['Estatísticas e Pontuações', 'Geral', 'Perguntas e Respostas']);
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testCancelFailNotLogged(): void {
        $movId = $this->getTaskId(Status::ACTIVE);
        $this->testUrlFailNotLogged('gerenciar/cancelar-tarefa/'.$movId);
    }

    public function testCancelTaskActiveSuccessLogged(): void {
        $movId = $this->getTaskId(Status::ACTIVE);
        $response = $this->get('gerenciar/cancelar-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertSessionHas('flash-success-msg', function ($value) {
            return preg_match("/Tarefa\s'(\d+)'\scancelada\scom\ssucesso!/", $value) ? true : false;
        });
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testCancelTaskCanceledFailLogged(): void {
        $movId = $this->getTaskId(Status::CANCELED);
        $response = $this->get('gerenciar/cancelar-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertSessionHas('flash-error-msg', function ($value) {
            return preg_match("/Erro ao cancelar a Tarefa\s'(\d+)'\.\sTarefa\s(\d+)\snão está Fechada pelo Sistema ou ativa para ser cancelada/", $value) ? true : false;
        });
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testCancelTaskClosedFailLogged(): void {
        $movId = $this->getTaskId(Status::CLOSED);
        $response = $this->get('gerenciar/cancelar-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertSessionHas('flash-error-msg', function ($value) {
            return preg_match("/Erro ao cancelar a Tarefa\s'(\d+)'\.\sTarefa\s(\d+)\snão está Fechada pelo Sistema ou ativa para ser cancelada/", $value) ? true : false;
        });
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testCloseFailNotLogged(): void {
        $movId = $this->getTaskId(Status::ACTIVE);
        $this->testUrlFailNotLogged('gerenciar/fechar-tarefa/'.$movId);
    }

    public function testCloseTaskActiveSuccessLogged(): void {
        $movId = $this->getTaskId(Status::ACTIVE);
        $response = $this->get('gerenciar/fechar-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertSessionHas('flash-success-msg', function ($value) {
            return preg_match("/Tarefa\s'(\d+)'\sfechada\scom\ssucesso!/", $value) ? true : false;
        });
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testCloseTaskClosedFailLogged(): void {
        $movId = $this->getTaskId(Status::CLOSED);
        $response = $this->get('gerenciar/fechar-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertSessionHas('flash-error-msg', function ($value) {
            return preg_match("/Erro ao fechar a Tarefa\s'(\d+)'\.\sTarefa\s(\d+)\snão está aberta para ser fechada/", $value) ? true : false;
        });
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testCloseTaskClosedBySystemFailLogged(): void {
        $movId = $this->getTaskId(Status::CLOSED_BY_SYSTEM);
        $response = $this->get('gerenciar/fechar-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertSessionHas('flash-error-msg', function ($value) {
            return preg_match("/Erro ao fechar a Tarefa\s'(\d+)'\.\sTarefa\s(\d+)\snão está aberta para ser fechada/", $value) ? true : false;
        });
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testCloseTaskCanceledFailLogged(): void {
        $movId = $this->getTaskId(Status::CANCELED);
        $response = $this->get('gerenciar/fechar-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertSessionHas('flash-error-msg', function ($value) {
            return preg_match("/Erro ao fechar a Tarefa\s'(\d+)'\.\sTarefa\s(\d+)\snão está aberta para ser fechada/", $value) ? true : false;
        });
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testReopenTaskFailNotLogged(): void {
        $movId = $this->getTaskId(Status::CANCELED);
        $this->testUrlFailNotLogged('gerenciar/reabrir-tarefa/'.$movId);
    }

    public function testReopenTaskCanceledSuccessLogged(): void {
        $movId = $this->getTaskId(Status::CANCELED);
        $response = $this->get('gerenciar/reabrir-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertSessionHas('flash-success-msg', function ($value) {
            return preg_match("/Tarefa\s'(\d+)'\sreaberta\scom\ssucesso!/", $value) ? true : false;
        });
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testReopenTaskClosedBySystemSuccessLogged(): void {
        $movId = $this->getTaskId(Status::CLOSED_BY_SYSTEM);
        $response = $this->get('gerenciar/reabrir-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertSessionHas('flash-success-msg', function ($value) {
            return preg_match("/Tarefa\s'(\d+)'\sreaberta\scom\ssucesso!/", $value) ? true : false;
        });
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testReopenTaskOpenedFailLogged(): void {
        $movId = $this->getTaskId(Status::ACTIVE);
        $response = $this->get('gerenciar/reabrir-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertSessionHas('flash-error-msg', function ($value) {
            return preg_match("/Erro ao reabrir a Tarefa\s'(\d+)'\.\sTarefa\s(\d+)\snão está Fechada pelo sistema ou cancelada para ser reaberta/", $value) ? true : false;
        });
        $response->assertCookieNotExpired('laravel_session');
    }

    public function testReopenTaskClosedFailLogged(): void {
        $movId = $this->getTaskId(Status::CLOSED);
        $response = $this->get('gerenciar/reabrir-tarefa/'.$movId, $this->getHeaderWEB());
        $response->assertStatus(302);
        $response->assertSessionHas('flash-error-msg', function ($value) {
            return preg_match("/Erro ao reabrir a Tarefa\s'(\d+)'\.\sTarefa\s(\d+)\snão está Fechada pelo sistema ou cancelada para ser reaberta/", $value) ? true : false;
        });
        $response->assertCookieNotExpired('laravel_session');
    }

    private function getTaskId(Status $status){
       $checklist = Checklist::create([
            'description' => 'Checklist Empilhadeira - Início de jornada de trabalho',
            'generate_time' => '00:00:00',
            'shelflife' => 30,
            'frequency' => 'D',
            'frequency_composition' => null,
            'status' => 'A',
            'chkl_type' => 'N',
            'changed_by_user' => 1,
            'chcl_id' => null
        ]);
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

        $serv = new ChecklistMovService();
        $units = Unity::where('id', 1)->get();
        $serv->generateChecklistMov($checklist, $units);

        $checklistMov = ChecklistMov::where('status', Status::ACTIVE->value)->first();

        switch ($status->value) {
            case Status::CLOSED_BY_SYSTEM->value: 
                $checklistMov->status = Status::CLOSED_BY_SYSTEM->value;
                $checklistMov->processed = 'S';
                $checklistMov->processed_in = now();
                $checklistMov->save();
                break;
            case Status::CLOSED->value: 
                $checklistMov->status = Status::CLOSED->value;
                $checklistMov->processed = 'S';
                $checklistMov->processed_in = now();
                $checklistMov->save();
                break;
            case Status::CANCELED->value:
                $checklistMov->status = Status::CANCELED->value;
                $checklistMov->processed = 'S';
                $checklistMov->processed_in = now();
                $checklistMov->save();
                break;
        }
        
        $checklistMov->refresh();
        return $checklistMov->id;
    }
}   
