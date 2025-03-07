@extends('layouts.template')

@section('content')
    <h3 class="mb-3">Listar Usuários</h3>

    <div class="row justify-content-end">
        <div class="col-2 mb-3 text-end">
            <a class="btn btn-outline-success" href="{{ route('user_create') }}">
                <i class="fas fa-plus"></i>
                Novo Usuário
            </a>
        </div>
    </div>

    <div>
        <div class="table-responsive-md">
            <table class="table table-striped table-sm fs--1 mb-0" id="user-list">
                <thead class="mt-5 bg-secondary text-light">
                    <tr>
                        <th class="sort-none align-middle fs-0 border-top pe-0">Ações</th>
                        <th class="sort align-middle border-top fs-0 ps-3 w-id" data-sort="id">Codigo</th>
                        <th class="sort align-middle border-top fs-0" data-sort="name">Nome</th>
                        <th class="sort align-middle border-top fs-0" data-sort="lastname">Sobrenome</th>
                        <th class="sort align-middle border-top fs-0" data-sort="login">Login</th>
                        <th class="sort align-middle border-top fs-0" data-sort="access_admin">Admin</th>
                        <th class="sort align-middle border-top fs-0" data-sort="access_mobile">Mobile</th>
                        <th class="sort align-middle border-top fs-0" data-sort="status">Status</th>
                    </tr>
                </thead>
                
                <tbody class="list">
                    @foreach ($users as $user)
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
                                        <a class="dropdown-item text-primary" href="{{ route('user_edit', $user->id ) }}">
                                            <i class="far fa-edit"></i>
                                            Editar
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <hr class="dropdown-divider">
                                    </li> --}}
                                    {{-- <li>
                                        <a class="dropdown-item text-danger" href="{{ route('user_delete', $user->id ) }}">
                                            <i class="far fa-trash-alt"></i>
                                            Remover
                                        </a>
                                    </li> --}}
                                </ul>
                            </div>
                        </td>
                        <td class="py--3 fw-bold align-middle ps-3 name">{{ $user->id }}</td>
                        <td class="py--3 align-middle">{{ $user->name }}</td>
                        <td class="py--3 align-middle">{{ $user->lastname }}</td>
                        <td class="py--3 align-middle">{{ $user->login }}</td>
                        <td class="py--3 align-middle w-status text-{{$user->access_admin == 'S'? 'success' : 'danger'}}">{{ $user->access_admin == 'S'? 'Sim' : 'Não' }}</td>
                        <td class="py--3 align-middle w-status text-{{$user->access_mobile == 'S'? 'success' : 'danger'}}">{{ $user->access_mobile == 'S'? 'Sim' : 'Não' }}</td>
                        <td class="py--3 align-middle w-status fw-bold {{$user->status == 'A' ? 'text-success ': 'text-danger'}}">
                            {{ Status::getDescription($user->status) }}
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
            initializeDatatables('user-list');
        });
    </script>
@endsection