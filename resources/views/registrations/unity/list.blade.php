@extends('layouts.template')

@section('content')
    <h3 class="mb-3">Listar Unidades</h3>

    <div class="row justify-content-end">
        <div class="col-3 mb-3 text-end">
            <a class="btn btn-outline-success" href="{{ route('unity_create') }}">
                <i class="fas fa-plus"></i>
                Nova Unidade
            </a>
        </div>
    </div>

    <div class="table-responsive mh-300">
        <table class="table table-striped table-sm fs--1 mb-0" id="unity-list">
            <thead class="mt-5 bg-secondary text-light">
                <tr>
                    <th class="sort border-top fs-0 ps-3 w-id" data-sort="id">Codigo</th>
                    <th class="sort border-top fs-0" data-sort="fantasy_name">Nome Fantasia</th>
                    <th class="sort border-top fs-0" data-sort="corporate_name">Razão Social</th>
                    <th class="sort border-top fs-0" data-sort="cnpj">CNPJ</th>
                    <th class="sort border-top fs-0" data-sort="status">Status</th>
                    <th class="sort align-middle fs-0 border-top pe-0">Ações</th>
                </tr>
            </thead>
            
            <tbody class="list">
                @foreach ($units as $unity)
                <tr class="py-1">
                    <td class="py--3 fw-bold align-middle ps-3 name">{{ $unity->id }}</td>
                    <td class="py--3 align-middle">{{ $unity->fantasy_name }}</td>
                    <td class="py--3 align-middle">{{ $unity->corporate_name }}</td>
                    <td class="py--3 align-middle">{{ $unity->cnpj }}</td>
                    <td class="py--3 align-middle w-status fw-bold {{$unity->status == 'A' ? 'text-success ': 'text-danger'}}">{{ Status::getDescription($unity->status) }}</td>
                    <td class="py--3 align-middle white-space-nowrap pe-0 w-action">
                        <div class="font-sans-serif btn-reveal-trigger position-static">
                            <button
                                class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs--2"
                                type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" 
                                aria-expanded="false" data-bs-reference="parent">
                                <i class="fa-solid fa-bars fs--2"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end py-2">
                                <a class="dropdown-item text-primary" href="{{ route('unity_edit', $unity->id ) }}">
                                    <i class="far fa-edit"></i>
                                    Editar
                                </a>
                                {{-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('unity_delete', $unity->id ) }}">
                                    <i class="far fa-trash-alt"></i>
                                    Remove
                                </a> --}}
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('postscript')
    <script type="text/javascript">
        $(document).ready(() => {
            initializeDatatables('unity-list');
        });
    </script>
@endsection