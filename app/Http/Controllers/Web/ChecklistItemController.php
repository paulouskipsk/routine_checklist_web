<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\WebChecklistItemRequest;
use App\Models\Checklist;
use App\Models\ChecklistItem;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ChecklistItemController extends ControllerWeb {
    private $breadcrumbs = [['url'=> '/checklist/listar','label' => 'Listar Checklists','active'=>true]];

    public function index(Request $request){
        $this->breadcrumbs[] = ['url'=> "/checklist-item/listar/checklist/$request->chkl_id",'label' => 'Listar Pergunta do Checklist','active'=>false];
        $breadcrumbs = $this->breadcrumbs;
        $itensChecklists = ChecklistItem::whereChklId($request->chkl_id)->orderBy('sequence')->get();
        $chkl_id = $request->chkl_id;
        $checklist = Checklist::find($request->chkl_id);

        return view('registrations.checklist-item.list', compact(['breadcrumbs', 'itensChecklists', 'checklist']));
    }

    public function create(Request $request){
        $this->breadcrumbs = [
            ['url'=> "/checklist-item/listar/checklist/$request->chkl_id",'label' => 'Listar Perguntas do Checklist','active'=>true],
            ['url'=> '', 'label' => 'Novo','active'=>false]
        ];
        $breadcrumbs = $this->breadcrumbs;
        $action = "/checklist-item/salvar";
        $method = 'post';
        $chkl_id = $request->chkl_id;
        $sectors = Sector::whereStatus('A')->get();
        $unitsChkl = (Checklist::with('units')->find($request->chkl_id))->units;

        return view('registrations.checklist-item.new', compact('breadcrumbs', 'action', 'method', 'sectors', 'chkl_id', 'unitsChkl'));
    }

    public function store(WebChecklistItemRequest $request){
        try {
            $data = $request->all();
            $data['changed_by_user'] = Auth::user()->id;
            ChecklistItem::create($data);
            Session::flash('flash-success-msg', "Pergunta cadastrada com sucesso.");
            return redirect("/checklist-item/listar/checklist/$request->chkl_id");
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro ao salvar a nova Pergunta.");
        }

        return Redirect::back()->with($request->all());
    }

    public function edit(Request $request){
        $chit = ChecklistItem::firstWhere('id',$request->id);
        $this->breadcrumbs = [
            ['url'=> "/checklist-item/listar/checklist/$chit->chkl_id",'label' => 'Listar Perguntas do Checklist','active'=>true],
            ['url'=> '', 'label' => 'Editar','active'=>false]
        ];
        $breadcrumbs = $this->breadcrumbs;
        $action = "/checklist-item/atualizar/$request->id";
        $method = 'put';
        $sectors = Sector::whereStatus('A')->get();        
        $chkl_id = $chit->chkl_id;
        $unitsChkl = (Checklist::with('units')->find($chit->chkl_id))->units;

        return view('registrations.checklist-item.edit', compact('breadcrumbs', 'action', 'method', 'chkl_id', 'chit', 'sectors', 'unitsChkl'));
    }

    public function update(WebChecklistItemRequest $request){
        try {
            $checklistItem = ChecklistItem::firstWhere('id', $request->id);
            $checklistItem->fill($request->all());
            $checklistItem->changed_by_user = Auth::user()->id;
            $checklistItem->processed_in = now();
            $checklistItem->save();

            Session::flash('flash-success-msg', "Pergunta atualizada com sucesso.");
            return redirect("/checklist-item/listar/checklist/$request->chkl_id");
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro ao atualizar o Pergunta $request->id.");
        }

        return Redirect::back()->with($request->all());
    }

    public function delete(Request $request){
        try {
            $checklistItem = ChecklistItem::firstWhere('id', $request->id);
            $checklist = $checklistItem->checklist;
            $checklistItem->checklistItensMovs()->exists() ? $checklistItem->delete() : $checklistItem->forceDelete();
            Session::flash('flash-success-msg', "Pergunta '$request->id' deletada com sucesso.");
        } catch (\Throwable $th) {
            Session::flash('flash-error-msg', "Erro ao deletado o Checklist $request->id. ".$th->getMessage());
        }
            return redirect(route('checklist_item_list', $checklist->id));
    }

}
