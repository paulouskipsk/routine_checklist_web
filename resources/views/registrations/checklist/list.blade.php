@extends('layouts.template')

@section('content')
    <h3 class="mb-3">Listar Checklists</h3>

    <div class="row justify-content-end">
        <div class="col-2 mb-3 text-end">
            <a class="btn btn-outline-success" href="{{ route('checklist_create') }}">
                <i class="fas fa-plus"></i>
                Novo Checklist
            </a>
        </div>
    </div>

    <div class="table-responsive-md">
        <table class="table table-striped table-sm fs--1 mb-0" id="checklist-list">
            <thead class="mt-5 bg-secondary text-light">
                <tr>
                    <th class="sort-none align-middle fs-0 pe-0 border-top">Ações</th>
                    <th class="sort align-middle border-top fs-0 ps-3 w-id" data-sort="id">Codigo</th>
                    <th class="sort align-middle border-top fs-0" data-sort="description">Descrição</th>
                    <th class="sort align-middle border-top fs-0" data-sort="status">Criado Em</th>
                    <th class="sort align-middle border-top fs-0" data-sort="status">Última <br/> Alteração</th>
                    <th class="sort align-middle border-top fs-0" data-sort="questions">Quant. <br/>Perguntas</th>
                    <th class="sort align-middle border-top fs-0" data-dt-order="disable">Status</th>
                </tr>
            </thead>
            
            <tbody class="list">
                @foreach ($checklists as $checklist)
                <tr class="py-1">
                    <td class="py--3 align-middle white-space-nowrap pe-0 w-action">
                        <div class="btn-group">
                            <button
                                class="btn btn-sm text-primary fw-bold dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2"
                                type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" 
                                aria-expanded="false" data-bs-reference="parent">
                                <i class="fa-solid fa-bars fs--2"></i>
                            </button>
                            
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item text-primary" href="{{ route('checklist_edit', $checklist->id ) }}">
                                        <i class="fas fa-edit"></i>
                                        Editar Checklist
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-info" href="{{ route('checklist_item_list', $checklist->id ) }}">
                                        <i class="far fa-edit"></i>
                                        Editar Perguntas
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-secondary"  
                                        onclick="getSelectUnitsModal(this)"
                                        data-checklist-id="{{ $checklist->id }}"
                                        data-checklist-units="{{ $checklist->units->pluck('id') }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#units-generate-task-modal">
                                        <i class="fas fa-cog"></i>
                                        Gerar Tarefa
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <button class="dropdown-item text-danger delete-checklist" 
                                            data-delete-route="{{ route('checklist_delete', $checklist->id ) }}"
                                            data-checklist-id="{{ $checklist->id }}">
                                        <i class="far fa-trash-alt"></i>
                                        Remover
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td class="py--3 fw-bold align-middle ps-3 name">{{ $checklist->id }}</td>
                    <td class="py--3 align-middle">{{ $checklist->description }}</td>
                    <td class="py--3 align-middle">{{ $checklist->created_at }}</td>
                    <td class="py--3 align-middle">{{ $checklist->updated_at }}</td>
                    <td class="py--3 align-middle {{ $checklist->checklistItens?->count() == 0 ? 'text-danger' : '' }}">
                        {{ $checklist->checklistItens?->count() }}
                    </td>

                    <td class="py--3 align-middle w-status fw-bold {{$checklist->status == 'A' ? 'text-success ': 'text-danger'}}">
                        {{ Status::getDescription($checklist->status) }}
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

  <!-- Modal -->
    <div class="modal modal-lg fade" id="units-generate-task-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Selecionar Unidades para Geração de Tarefa Manual</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" id="checklist-id-modal">

                    <div class="row d-flex justify-content-center mt-5">
                        <div class="col-12" id="select-unity-for-task"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-secondary" id="btn-generate-tasks">Gerar Tarefas</button>
                </div>
            </div>
        </div>
    </div>
  <!-- /Modal -->
@endsection

@section('postscript')
    <script type="text/javascript">

        function deleteChecklist(element) {            
            event.preventDefault();
            var deleteRoute = element.getAttribute('data-delete-route');
            var checklistId = element.getAttribute('data-checklist-id');

            Swal.fire({
                title: "Confirmação",
                text: `Tem certeza que deseja deletar o Ckecklist ${checklistId} e suas Perguntas?!`,
                icon: "warning",
                position: "top",
                showCancelButton: true,
                cancelButtonColor: "#ed2000",
                confirmButtonColor: "#25b003",
                confirmButtonText: "Confirmar"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteRoute;
                }else{
                    Swal.fire({
                        position: "top",
                        title: "Cancelado!",
                        text: `A exclusão do Checklist ${checklistId} não foi realizada!`,
                        icon: "info",
                        confirmButtonColor: "#25b003",
                    });
                }
            });
        }

        function getSelectUnitsModal(btnGenerateTask){
            event.preventDefault();

            let select = '';
            let checklistUnits = $(btnGenerateTask).data('checklist-units');
            let checklistId = $(btnGenerateTask).data('checklist-id');
            let allUnits = <?= $units ?>;

            let selectUnityForTask = '<select multiple="multiple" name="unitsGenerateTask[]" id="units-generate-task-select"> \n';
            checklistUnits.forEach(unityChkl => {
                let unity = allUnits[unityChkl];
                selectUnityForTask +=`<option value="${unity.id}"> ${unity.id} - ${unity.fantasy_name} </option>\n`;
            });
            selectUnityForTask += '</select>';

            $("#select-unity-for-task").empty();
            $("#select-unity-for-task").append(selectUnityForTask);
            $("#checklist-id-modal").val(checklistId);

            select = $('[name=duallistbox_demo1]').bootstrapDualListbox();   
            select.bootstrapDualListbox('refresh');
            initializeDualListBox('#units-generate-task-select', 'Unidades Ativas', 'Unidades Selecionadas');

        }

        function generateTasks(){
            try {
                $('#text-preloader').html("Processando");
                $('#preloader').show();
                
                let unitsSelecteds = $('#units-generate-task-select').val();
                let checklistId = $('#checklist-id-modal').val();
                let csrf_token = "{{ csrf_token() }}";
                let route = "{{ route('checklist_generate') }}";

                if(!unitsSelecteds) throw Exception("Nenhuma unidade selecionada.");

                $.ajax({
                    'processing': true,
                    'serverSide': false,
                    type: "POST",
                    url: route,
                    data: {
                        units: unitsSelecteds,
                        checklistId: checklistId,
                        _token: csrf_token
                    },
                    success: function(data) { 
                        $('#preloader').delay(150).fadeOut();
                        Swal.fire({
                            position: "top",
                            title: "Sucesso!",
                            text: data.message,
                            icon: "success"
                        });
                        bootstrap.Modal.getOrCreateInstance($('#units-generate-task-modal')).hide();
                    },
                    error: function(data) { 
                        $('#preloader').delay(150).fadeOut();
                        Swal.fire({
                            position: "top",
                            title: "Erro!",
                            text: data.responseJSON.message,
                            icon: "error"
                        });
                    }  
                });
            } catch ($error) {
                $('#preloader').delay(150).fadeOut();
                console.log($error)
                Swal.fire({
                    position: "top",
                    title: "Erro!",
                    text: data.message ?? $error,
                    icon: "error"
                });
            }
        }

        $(document).ready(function() {
            initializeDatatables('checklist-list');
            initializeDualListBox('#units-generate-task', 'Unidades Ativas', 'Unidades Selecionadas');
            $("#btn-generate-tasks").click(function(){ generateTasks(); });
            $(".delete-checklist").click(function(event){ deleteChecklist(this); });
            
        });
    </script>
@endsection