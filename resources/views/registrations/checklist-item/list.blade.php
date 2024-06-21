@extends('layouts.template')

@section('content')
    <h3 class="mb-3">Listar Perguntas do checklist: {{ $checklist->id }} </h3>
    <h4 class="text-primary">{{$checklist->description}}</h4>

    <div class="row justify-content-end">
        <div class="col-2 mb-3 text-end">
            <a class="btn btn-outline-success" href="{{ route('checklist_item_create', $checklist->id) }}">
                <i class="fas fa-plus"></i>
                Nova Pergunta
            </a>
        </div>
    </div>

    <div class="table-responsive-md">
        <table class="table table-striped table-sm fs--1 mb-0" id="checklist-list">
            <thead class="mt-5 bg-secondary text-light">
                <tr>
                    <th class="sort-none align-middle fs-0 pe-0 border-top">Ações</th>
                    <th class="sort align-middle border-top fs-0 ps-3 w-id" data-sort="id">Cod.</th>
                    <th class="sort align-middle border-top fs-0 ps-3 w-id" data-sort="id">Seq.</th>
                    <th class="sort align-middle border-top fs-0" data-sort="score">Peso</th>
                    <th class="sort align-middle border-top fs-0" data-sort="description">Descrição da Pergunta</th>
                    <th class="sort align-middle border-top fs-0" data-sort="score">H Min.</th>
                    <th class="sort align-middle border-top fs-0" data-sort="score">H Max.</th>
                    <th class="sort align-middle border-top fs-0" data-sort="status">Última Alteração</th>
                    <th class="sort align-middle border-top fs-0" data-sort="status">Status</th>
                </tr>
            </thead>
            
            <tbody class="list">
                @foreach ($itensChecklists as $itemChecklist)
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
                                    <a class="dropdown-item text-primary" href="{{ route('checklist_item_edit', $itemChecklist->id ) }}">
                                        <i class="far fa-edit"></i>
                                        Editar
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <button class="dropdown-item text-danger delete-checklist-item" 
                                            data-delete-route="{{ route('checklist_item_delete', $itemChecklist->id ) }}"
                                            data-checklist-item-id="{{ $itemChecklist->id }}">
                                        <i class="far fa-trash-alt"></i>
                                        Remover
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td class="py--3 fw-bold align-middle ps-3 name">{{ $itemChecklist->id }}</td>
                    <td class="py--3 align-middle ps-3 name">{{ $itemChecklist->sequence }}</td>
                    <td class="py--3 align-middle">{{ $itemChecklist->score }}</td>
                    <td class="py--3 align-middle">{{ $itemChecklist->description }}</td>
                    <td class="py--3 align-middle">{{ $itemChecklist->hour_min }}</td>
                    <td class="py--3 align-middle">{{ $itemChecklist->hour_max }}</td>
                    <td class="py--3 align-middle">{{ $itemChecklist->updated_at }}</td>
                    <td class="py--3 align-middle w-status fw-bold {{$itemChecklist->status == 'A' ? 'text-success ': 'text-danger'}}">
                        {{ Status::getDescription($itemChecklist->status) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('postscript')
    <script type="text/javascript">
        function deleteChecklistItem(element) {            
                event.preventDefault();
                var deleteRoute = element.getAttribute('data-delete-route');
                var checklistItemId = element.getAttribute('data-checklist-item-id');

                Swal.fire({
                    title: "Confirmação",
                    text: `Tem certeza que deseja deletar a pergunta '${checklistItemId}' ?!`,
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
                            text: `A exclusão da pergunta '${checklistItemId}' não foi realizada!`,
                            icon: "info",
                            confirmButtonColor: "#25b003",
                        });
                    }
                });
            }

        $(document).ready(() => {
            initializeDatatables('checklist-list');
            $(".delete-checklist-item").click(function(event){ deleteChecklistItem(this); });

        });
    </script>
@endsection