@extends('layouts.template')

@section('content')
    <h3 class="mb-3">Gerenciar Tarefas de Checklists</h3>

    <div class="accordion">
        <div class="accordion-item border border-300 rounded-2 px-4 py-2">
            <h2 class="accordion-header">
                <button class="accordion-button" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#panelsStayOpen-collapseOne"
                        aria-expanded="true" 
                        aria-controls="panelsStayOpen-collapseOne">
                    Filtros
                </button>
            </h2>

            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <div class="accordion-body">
                
                    <form action="{{route('manage_tasks')}}" method="GET" role="form">
                        @csrf
                        @method('GET')

                        <div class="row">
                            <div class="col-sm-6 col-md-2 mx-0 px-1">
                                <label class="form-label" for="datepicker">Data Inicial</label>
                                <input 
                                    class="form-control datetimepicker" 
                                    id="start_date" 
                                    name="start_date" 
                                    value="{{$startDate->format('d/m/Y')}}"
                                    type="text" 
                                    placeholder="dd/mm/yyyy" 
                                    data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' />
                            </div>

                            <div class="col-sm-6 col-md-2 mx-0 px-1">
                                <label class="form-label" for="datepicker">Data Final</label>
                                <input 
                                    class="form-control datetimepicker" 
                                    id="start_date" 
                                    value="{{$endDate->format('d/m/Y')}}"
                                    name="end_date" 
                                    type="text" 
                                    placeholder="dd/mm/yyyy" 
                                    data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' />
                            </div>

                            <div class="col-8">
                                <label class="form-label" for="datepicker">Unidades Selecionadas</label>
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary" 
                                            type="button"
                                            onclick="getSelectUnitsModal(this)"
                                            data-checklist-units="{{ $units->pluck('id') }}"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#select-units-modal"
                                            type="button"
                                            id="select-units">
                                            Selecionar
                                    </button>
                                    <input type="text" 
                                           name="units" 
                                           value="{{Functions::formatIdsUnits($unitsSelecteds)}}" 
                                           id="units-selecteds-input" 
                                           class="form-control" 
                                           placeholder="Não há unidades Selecionadas">
                                  </div>
                            </div>
                        </div>
                            
                        <div class="row justify-content-end">
                            <div class="col-12 mb-0 text-end">
                                <button class="btn btn-outline-success " type="submit">
                                    <i class="fa-solid fa-check-double"></i>
                                    Aplicar Filtro
                                </button> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="table-responsive mt-4">
        <table class="table table-striped table-sm fs--1 mb-0" id="checklist-list">
            <thead class="mt-5 bg-secondary text-light">
                <tr>
                    <th class="sort align-middle fs-0 pe-0 border-top">Ações</th>
                    <th class="sort border-top fs-0" data-sort="unity">Unidade</th>
                    <th class="sort border-top fs-0" data-sort="id">Codigo</th>
                    <th class="sort border-top fs-0" data-sort="status">Status</th>
                    <th class="sort border-top fs-0" data-sort="description">Descrição</th>
                    <th class="sort border-top fs-0" data-sort="status">Criado Em</th>
                    <th class="sort border-top fs-0" data-sort="status">Tarefa Livre</th>
                    <th class="sort border-top fs-0" data-sort="status">Usuário Vinc.</th>
                </tr>
            </thead>
            
            <tbody class="list">
                @foreach ($checklists as $checklist)
                <tr class="py-1">
                    <td class="py--3 align-middle white-space-nowrap pe-0 w-action">
                        <div class="font-sans-serif btn-reveal-trigger position-static  dropend">
                            <button
                                class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2"
                                type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" 
                                aria-expanded="false" data-bs-reference="parent">
                                <i class="fa-solid fa-bars fs--2"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end py-2">
                                <button type="button" class="dropdown-item text-dark" {{$checklist->status != Status::ACTIVE->value ? 'disabled': '' }}>
                                    <a class="text-decoration-none {{$checklist->status != Status::ACTIVE->value ? 'text-gray': '' }}" 
                                        href="{{ route('close_task', $checklist->id ) }}">
                                        <i class="fa-solid fa-lock"></i>
                                        <span class="mx-2">Fechar Tarefa</span>
                                    </a>
                                </button>

                                <button type="button" class="dropdown-item text-dark" 
                                        {{$checklist->status != Status::CLOSED_BY_SYSTEM->value && $checklist->status != Status::CANCELED->value ? 'disabled': '' }}>
                                    <a class="text-decoration-none {{$checklist->status != Status::CLOSED_BY_SYSTEM->value && $checklist->status != Status::CANCELED->value ? 'text-gray': '' }}" 
                                        href="{{ route('reopen_task', $checklist->id ) }}">
                                        <i class="fa-solid fa-lock-open"></i>
                                        <span class="mx-2">Reabrir Tarefa</span>
                                    </a>
                                </button>

                                <button type="button" class="dropdown-item text-dark">
                                    <a class="text-decoration-none" href="{{ route('view_task', $checklist->id ) }}">
                                        <i class="fa-regular fa-eye"></i>
                                        <span class="mx-2">Visualizar Tarefa</span>
                                    </a>
                                </button>

                                <div class="dropdown-divider"></div>
                                <button type="button" 
                                        class="dropdown-item" {{$checklist->status == Status::ACTIVE->value || $checklist->status == Status::CLOSED_BY_SYSTEM->value ? '': 'disabled' }}>
                                    <a class="text-decoration-none {{$checklist->status == Status::ACTIVE->value || $checklist->status == Status::CLOSED_BY_SYSTEM->value ? 'text-danger' : 'text-gray'}}" 
                                        href="{{ route('cancel_task', $checklist->id ) }}">
                                        <i class="far fa-trash-alt"></i>
                                        <span class="mx-2">Cancelar Tarefa</span>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="py--3 align-middle w-id">{{str_pad($checklist->unity->id , 3 , '0' , STR_PAD_LEFT)}}</td>
                    <td class="py--3 fw-bold align-middle w-id">{{ $checklist->id }}</td>
                    <td class="py--3 align-middle w-status fw-bold">
                        <span class="badge badge-phoenix badge-phoenix-{{$checklist->status == 'A' ? 'success' : 
                                                                         ($checklist->status == 'F' ? 'secondary' : 
                                                                         ($checklist->status == 'S' ? 'danger' : 'warning'))}} w-100">
                            {{ Status::getDescription($checklist->status) }}
                        </span>
                    </td>
                    <td class="py--3 align-middle">{{ $checklist->description }}</td>
                    <td class="py--3 align-middle">{{ $checklist->created_at }}</td>
                    <td class="py--3 align-middle">
                        <span class="badge badge-phoenix badge-phoenix-{{$checklist->is_free=='S'?'success':'danger'}}">
                            {{ $checklist->is_free == 'S' ? 'Liberado': 'Vinculado'}}
                        </span>
                    </td>                    
                    <td class="py--3 align-middle">{{$checklist->user ? $checklist->user->id.' - '.$checklist->user->name : ''}}</td>  
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

  <!-- Modal -->
  <div class="modal modal-lg fade" id="select-units-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Selecionar Unidades para o filtro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="units-selecteds">

                <div class="row d-flex justify-content-center mt-5">
                    <div class="col-12" id="select-unity-for-filter"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-confirm">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->
@endsection

@section('postscript')
    <script type="text/javascript">
        let units = <?= json_encode($units->pluck('id')) ?>;
        let unitsSelecteds = <?= json_encode($unitsSelecteds) ?>;
        let dataSource = [];
    

        function getSelectUnitsModal(){
            event.preventDefault();
            let select = '';
            let allUnits = <?= $units ?>; 
            let unitsSelecteds = ($("#units-selecteds-input").val()).split(',');

            let selectUnityForFilter = '<select multiple="multiple" name="unitsSelecteds[]" id="units-selecteds"> \n';
                allUnits.forEach(unity => {
                let selected = unitsSelecteds.includes(("000" + unity.id).slice(-3)) ? 'selected' : '';
                selectUnityForFilter +=`<option value="${unity.id}" ${selected}> ${unity.id} - ${unity.fantasy_name} </option>\n`;
            });
            selectUnityForFilter += '</select>';

            $("#select-unity-for-filter").empty();
            $("#select-unity-for-filter").append(selectUnityForFilter);
            initializeDualListBox('#select-unity-for-filter', 'Unidades Ativas', 'Unidades Selecionadas');
        }

        function confirmSelectUnits(){
            let unitsSelecteds = [];            
            $("#select-unity-for-filter").find("option:selected").each(function() {
                unitsSelecteds.push(("000" + $(this).val()).slice(-3));
            });
            $("#units-selecteds-input").val(unitsSelecteds);
        }

        $(document).ready(function() {
            initializeDatatables('checklist-list');

            $("#select-units").click(function(){ 
                getSelectUnitsModal();
            });

            $("#btn-confirm").click(function(){ 
                confirmSelectUnits();
            });
        });
    </script>
@endsection