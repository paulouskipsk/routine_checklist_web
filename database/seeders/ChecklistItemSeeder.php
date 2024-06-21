<?php

namespace Database\Seeders;

use App\Models\Checklist;
use App\Models\ChecklistItem;
use App\Models\Sector;
use App\Models\Unity;
use Illuminate\Database\Seeder;

class ChecklistItemSeeder extends Seeder {

    private $sectorFrCxId;
    private $sectorDepId;
    private $sectorAcoId;
    private $sectorPadId;
    private $sectorMerId;
    private $sectorHorId;
    private $chklEmpilhadeira;
    private $chklSesmt;
    private $chklAbertura;
    private $chklLimpeza;

    public function run(): void {
        $this->sectorFrCxId = Sector::where('description', 'ilike', 'Fr. Caixa')->first();
        $this->sectorFrCxId = $this->sectorFrCxId->id;
        $this->sectorDepId = Sector::where('description', 'ilike', 'Depósito')->first();
        $this->sectorDepId = $this->sectorDepId->id;
        $this->sectorAcoId = Sector::where('description', 'ilike', 'Açougue')->first();
        $this->sectorAcoId = $this->sectorAcoId->id;
        $this->sectorPadId = Sector::where('description', 'ilike', 'Padaria')->first();
        $this->sectorPadId = $this->sectorPadId->id;
        $this->sectorMerId = Sector::where('description', 'ilike', 'Mercearia')->first();
        $this->sectorMerId = $this->sectorMerId->id;
        $this->sectorHorId = Sector::where('description', 'ilike', 'Hortifrutti')->first();
        $this->sectorHorId = $this->sectorHorId->id;
        $this->chklEmpilhadeira = Checklist::where('description', 'ilike', 'Checklist Empilhadeira - Início de jornada de trabalho')->first();
        $this->chklEmpilhadeira = $this->chklEmpilhadeira->id;
        $this->chklSesmt = Checklist::where('description', 'ilike', 'Checklist Sesmt Açogue')->first();
        $this->chklSesmt = $this->chklSesmt->id;
        $this->chklAbertura = Checklist::where('description', 'ilike', 'Checklist Abertura de Loja')->first();
        $this->chklAbertura = $this->chklAbertura->id;
        $this->chklLimpeza = Checklist::where('description', 'ilike', 'Checklist Limpeza Loja')->first();
        $this->chklLimpeza = $this->chklLimpeza->id;

        $this->createQuestionsForChklEmpilhadeira();
        $this->createQuestionsForChklLimpeza();
        $this->createQuestionsForChklAbertura();
        $this->createQuestionsForChklSesmt();
    }

    private function createQuestionsForChklEmpilhadeira() {

        ChecklistItem::create([
            'description' => 'Os faróis dianteiros estão funcionando corretamente?',
            'sequence' => 1,
            'score' => 1,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '00:30',
            'shelflife' => 30,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'type_obs' => 'O',
            'sect_id' => $this->sectorDepId,
            'chkl_id' => $this->chklEmpilhadeira,
        ]);

        ChecklistItem::create([
            'description' => 'O sinal sonoro está funcionando corretamente?',
            'sequence' => 2,
            'score' => 1,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '00:30',
            'shelflife' => 30,
            'required_photo' => 'N',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'type_obs' => 'O',
            'sect_id' => $this->sectorDepId,
            'chkl_id' => $this->chklEmpilhadeira,
        ]);

        ChecklistItem::create([
            'description' => 'O giroflex está funcionando?',
            'sequence' => 3,
            'score' => 1,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '00:30',
            'shelflife' => 30,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'type_obs' => 'O',
            'sect_id' => $this->sectorDepId,
            'chkl_id' => $this->chklEmpilhadeira,
        ]);

        ChecklistItem::create([
            'description' => 'Os pneus estão em boas condições?',
            'sequence' => 4,
            'score' => 1,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '00:30',
            'shelflife' => 30,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'type_obs' => 'O',
            'sect_id' => $this->sectorDepId,
            'chkl_id' => $this->chklEmpilhadeira,
        ]);

        ChecklistItem::create([
            'description' => 'O sistema de alimentação (mangueiras e botijão), bem como o sistema hidráulico (mangueiras e bomba) apresentam sinais de vazamento?',
            'sequence' => 5,
            'score' => 1,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '00:30',
            'shelflife' => 30,
            'required_photo' => 'N',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'type_obs' => 'O',
            'sect_id' => $this->sectorDepId,
            'chkl_id' => $this->chklEmpilhadeira,
        ]);

        ChecklistItem::create([
            'description' => 'O radiador está com níveis de água aceitáveis?',
            'sequence' => 6,
            'score' => 1,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '00:30',
            'shelflife' => 30,
            'required_photo' => 'N',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'type_obs' => 'O',
            'sect_id' => $this->sectorDepId,
            'chkl_id' => $this->chklEmpilhadeira,
        ]);
    }

    private function createQuestionsForChklLimpeza(){

        ChecklistItem::create([
            'description' => 'A Frente de Caixa está limpa e organizada para o trabalho?',
            'sequence' => 1,
            'score' => 2,
            'status' => 'A',
            'type' => 'A',
            'hour_min' => '08:00',
            'hour_max' => '10:00',
            'shelflife' => 60,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'sect_id' => $this->sectorFrCxId,
            'chkl_id' => $this->chklLimpeza,
        ]);

        ChecklistItem::create([
            'description' => 'O Balcão do Acougue está limpo e organizado para o trabalho?',
            'sequence' => 2,
            'score' => 5,
            'status' => 'A',
            'type' => 'A',
            'hour_min' => '08:00',
            'hour_max' => '10:00',
            'shelflife' => 60,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'sect_id' => $this->sectorAcoId,
            'chkl_id' => $this->chklLimpeza,
        ]);

        ChecklistItem::create([
            'description' => 'O Balcão da Padaria está limpo e organizado para o trabalho?',
            'sequence' => 3,
            'score' => 5,
            'status' => 'A',
            'type' => 'A',
            'hour_min' => '08:00',
            'hour_max' => '10:00',
            'shelflife' => 60,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'sect_id' => $this->sectorPadId,
            'chkl_id' => $this->chklLimpeza,
        ]);

        ChecklistItem::create([
            'description' => 'As bancas de Hortifrutti estão limpas e organizadas para a venda?',
            'sequence' => 4,
            'score' => 3,
            'status' => 'A',
            'type' => 'A',
            'hour_min' => '08:00',
            'hour_max' => '10:00',
            'shelflife' => 60,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'sect_id' => $this->sectorHorId,
            'chkl_id' => $this->chklLimpeza,
        ]);

        ChecklistItem::create([
            'description' => 'Os corredores e Gondolas da loja estão limpos e organizadas para a venda?',
            'sequence' => 5,
            'score' => 2,
            'status' => 'A',
            'type' => 'A',
            'hour_min' => '08:00',
            'hour_max' => '10:00',
            'shelflife' => 60,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'sect_id' => $this->sectorMerId,
            'chkl_id' => $this->chklLimpeza,
        ]);

        ChecklistItem::create([
            'description' => 'O Depósito da loja está limpo e organizado?',
            'sequence' => 6,
            'score' => 1,
            'status' => 'A',
            'type' => 'A',
            'hour_min' => '08:00',
            'hour_max' => '10:00',
            'shelflife' => 60,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'sect_id' => $this->sectorDepId,
            'chkl_id' => $this->chklLimpeza,
        ]);
    }

    private function createQuestionsForChklAbertura(){
        ChecklistItem::create([
            'description' => 'As portas e janelas da loja estão abertas?',
            'sequence' => 1,
            'score' => 1,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '07:50',
            'hour_max' => '08:00',
            'shelflife' => 10,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'type_obs' => 'O',
            'sect_id' => $this->sectorFrCxId,
            'chkl_id' => $this->chklAbertura,
        ]);

        ChecklistItem::create([
            'description' => 'O Pão Francês já está assado e pronto para ser vendido?',
            'sequence' => 2,
            'score' => 3,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '07:30',
            'hour_max' => '08:00',
            'shelflife' => 30,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'type_obs' => 'O',
            'sect_id' => $this->sectorPadId,
            'chkl_id' => $this->chklAbertura,
        ]);

        ChecklistItem::create([
            'description' => 'O Balcão do açougue bem abastecido e precificado?',
            'sequence' => 3,
            'score' => 3,
            'status' => 'A',
            'type' => 'A',
            'hour_min' => '07:30',
            'hour_max' => '08:00',
            'shelflife' => 30,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'type_obs' => 'O',
            'sect_id' => $this->sectorAcoId,
            'chkl_id' => $this->chklAbertura,
        ]);

        ChecklistItem::create([
            'description' => 'O Setor de Frente de caixa está bem organizado, com as máquinas em operação?',
            'sequence' => 4,
            'score' => 3,
            'status' => 'A',
            'type' => 'A',
            'hour_min' => '07:30',
            'hour_max' => '08:00',
            'shelflife' => 30,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'type_obs' => 'O',
            'sect_id' => $this->sectorFrCxId,
            'chkl_id' => $this->chklAbertura,
        ]);
    }

    private function createQuestionsForChklSesmt(){
        ChecklistItem::create([
            'description' => 'Os movimentos da fita no entorno das polias estão protegidos com proteções fixas ou proteções móveis intertravadas, com exceção da área operacional necessária para o corte da carne?',
            'sequence' => 1,
            'score' => 10,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '23:59',
            'shelflife' => 24,
            'required_photo' => 'S',
            'quant_photo' => 2,
            'changed_by_user' => 1,
            'type_obs' => 'O',
            'sect_id' => $this->sectorAcoId,
            'chkl_id' => $this->chklSesmt,
        ]);

        ChecklistItem::create([
            'description' => 'A canaleta regulável deslizante está enclausurando o perímetro da fita serrilhada na região de corte, liberando apenas a área mínima de fita serrilhada para operação.?',
            'sequence' => 2,
            'score' => 10,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '23:59',
            'shelflife' => 24,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'type_obs' => 'O',
            'sect_id' => $this->sectorAcoId,
            'chkl_id' => $this->chklSesmt,
        ]);

        ChecklistItem::create([
            'description' => 'A serra fita possui, no mínimo, um botão de parada de emergência?',
            'sequence' => 3,
            'score' => 20,
            'status' => 'A',
            'type' => 'S',
            'hour_min' => '00:00',
            'hour_max' => '23:59',
            'shelflife' => 24,
            'required_photo' => 'S',
            'quant_photo' => 1,
            'changed_by_user' => 1,
            'type_obs' => 'O',
            'sect_id' => $this->sectorAcoId,
            'chkl_id' => $this->chklSesmt,
        ]);
    }
}
