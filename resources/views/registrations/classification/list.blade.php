@extends('layouts.template')

@section('content')
    <h3 class="mb-3">Listar Classificações</h3>

    <div class="row justify-content-end">
        <div class="col-2 mb-3 text-end">
            <a class="btn btn-outline-success" href="{{ route('classification_create') }}">
                <i class="fas fa-plus"></i>
                Nova Classificação
            </a>
        </div>
    </div>

    <div id="tableExample2">
        <div class="table-responsive-md">
            <table class="table table-striped table-sm fs--1 mb-0" id="classification-list">
                <thead class="mt-5 bg-secondary text-light">
                    <tr>
                        <th class="sort-none align-middle fs-0 pe-0 border-top">Ações</th>
                        <th class="sort align-middle border-top fs-0 ps-3 w-id" data-sort="id">Codigo</th>
                        <th class="sort align-middle border-top fs-0" data-sort="description">Descrição</th>
                        <th class="sort align-middle border-top fs-0" data-sort="status">Status</th>
                    </tr>
                </thead>
                
                <tbody class="list">
                    @foreach ($classifications as $classification)
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
                                        <a class="dropdown-item text-primary" href="{{ route('classification_edit', $classification->id ) }}">
                                            <i class="far fa-edit"></i>
                                            Editar
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{ route('classification_delete', $classification->id ) }}">
                                            <i class="far fa-trash-alt"></i>
                                            Remove
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td class="py--3 fw-bold align-middle ps-3 name">{{ $classification->id }}</td>
                        <td class="py--3 align-middle">{{ $classification->description }}</td>
                        <td class="py--3 align-middle w-status fw-bold {{$classification->status == 'A' ? 'text-success ': 'text-danger'}}">
                            {{ Status::getDescription($classification->status) }}
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
            initializeDatatables('classification-list');
        });
    </script>
@endsection