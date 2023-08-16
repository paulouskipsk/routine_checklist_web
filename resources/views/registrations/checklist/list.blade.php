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

    <div id="tableExample2">
        <div class="table-responsive">
            <table class="table table-striped table-sm fs--1 mb-0" id="checklist-list">
                <thead class="mt-5">
                    <tr>
                        <th class="sort border-top fs-0 ps-3 w-id" data-sort="id">Codigo</th>
                        <th class="sort border-top fs-0" data-sort="description">Descrição</th>
                        <th class="sort border-top fs-0" data-sort="status">Criado Em</th>
                        <th class="sort border-top fs-0" data-sort="status">Ultima Alteração</th>
                        <th class="sort border-top fs-0" data-sort="status">Status</th>
                        <th class="sort text-end align-middle fs-0 pe-0 border-top" scope="col">Ações</th>
                    </tr>
                </thead>
                
                <tbody class="list">
                    @foreach ($checklists as $checklist)
                    <tr class="py-1">
                        <td class="py--3 fw-bold align-middle ps-3 name">{{ $checklist->id }}</td>
                        <td class="py--3 align-middle">{{ $checklist->description }}</td>
                        <td class="py--3 align-middle">{{ $checklist->created_at }}</td>
                        <td class="py--3 align-middle">{{ $checklist->updated_at }}</td>
                        <td class="py--3 align-middle w-status fw-bold {{$checklist->status == 'A' ? 'text-success ': 'text-danger'}}">{{ Status::getDescription($checklist->status) }}</td>
                        <td class="py--3 align-middle white-space-nowrap text-end pe-0 w-action">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                                <button
                                    class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2"
                                    type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" 
                                    aria-expanded="false" data-bs-reference="parent">
                                    <i class="fa-solid fa-bars fs--2"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end py-2">
                                    <a class="dropdown-item text-primary" href="{{ route('checklist_edit', $checklist->id ) }}">
                                        <i class="far fa-edit"></i>
                                        Editar
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="{{ route('checklist_delete', $checklist->id ) }}">
                                        <i class="far fa-trash-alt"></i>
                                        Remove
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
            <ul class="mb-0 pagination"></ul>
            <button class="page-link pe-0" data-list-pagination="next"><span
                    class="fas fa-chevron-right"></span></button>
        </div>
    </div>
@endsection

@section('postscript')
    <script type="text/javascript">
        $(document).ready(() => {
            $('#checklist-list').DataTable({
                lengthMenu: [
                    [30, 50, 100, -1],
                    [30, 50, 100, 'All']
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ],

                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
                },

            });
        });
    </script>
@endsection