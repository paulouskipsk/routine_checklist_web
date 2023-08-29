@extends('layouts.template')

@section('content')
    <h3 class="mb-3">Listar Grupos de Usuários</h3>

    <div class="row justify-content-end">
        <div class="col-2 mb-3 text-end">
            <a class="btn btn-outline-success" href="{{ route('user_group_create') }}">
                <i class="fas fa-plus"></i>
                Novo Grupo de Usuários
            </a>
        </div>
    </div>

    <div id="tableExample2">
        <div class="table-responsive mh-300">
            <table class="table table-striped table-sm fs--1 mb-0" id="userGroup-list">
                <thead class="mt-5">
                    <tr>
                        <th class="sort border-top fs-0 ps-3 w-id" data-sort="id">Codigo</th>
                        <th class="sort border-top fs-0" data-sort="name">Nome</th>
                        <th class="sort border-top fs-0" data-sort="status">Status</th>
                        <th class="sort text-end align-middle fs-0 pe-0 border-top" scope="col">Ações</th>
                    </tr>
                </thead>
                
                <tbody class="list">
                    @foreach ($userGroups as $userGroup)
                    <tr class="py-1">
                        <td class="py--3 fw-bold align-middle ps-3 name">{{ $userGroup->id }}</td>
                        <td class="py--3 align-middle">{{ $userGroup->name }}</td>
                        <td class="py--3 align-middle w-status fw-bold {{$userGroup->status == 'A' ? 'text-success ': 'text-danger'}}">{{ Status::getDescription($userGroup->status) }}</td>
                        <td class="py--3 align-middle white-space-nowrap text-end pe-0 w-action">
                            <div class="font-sans-serif btn-reveal-trigger position-static">
                                <button
                                    class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2"
                                    type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" 
                                    aria-expanded="false" data-bs-reference="parent">
                                    <i class="fa-solid fa-bars fs--2"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end py-2">
                                    <a class="dropdown-item text-primary" href="{{ route('user_group_edit', $userGroup->id ) }}">
                                        <i class="far fa-edit"></i>
                                        Editar
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="{{ route('user_group_delete', $userGroup->id ) }}">
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
    </div>
@endsection

@section('postscript')
    <script type="text/javascript">
        $(document).ready(() => {
            $('#userGroup-list').DataTable({
                lengthMenu: [
                    [30, 50, 100, -1],
                    [30, 50, 100, 'All']
                ],
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