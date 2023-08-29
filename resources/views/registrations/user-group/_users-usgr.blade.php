
<section id="users-usgr" class="mt-5 pb-5">

    <div class="row justify-content-end">
        <div class="col-3 mb-3 text-end">
            <a class="btn btn-outline-success mt-4" data-bs-toggle="modal" data-bs-target="#include-user">
                <i class="fas fa-plus"></i>
                Incluir Usuário
            </a>
        </div>
    </div>

    <div class="table-responsive mh-300">
        <table class="table table-striped table-sm fs--1 mb-0" id="user-group-users">
            <thead class="mt-5">
                <tr>
                    <th class="sort border-top fs-0 ps-3 w-id" data-sort="id">Cod. usuário</th>
                    <th class="sort border-top fs-0" data-sort="name">Nome usuário</th>
                    <th class="sort text-end align-middle fs-0 pe-0 border-top" scope="col">Ações</th>
                </tr>
            </thead>
            
            <tbody class="list">
                @foreach ($userGroup->users as $user)
                <tr class="py-1">
                    <td class="py--3 fw-bold align-middle ps-3 name">{{ $user->id }}</td>
                    <td class="py--3 align-middle">{{ $user->name }}</td>
                    <td class="py--3 align-middle white-space-nowrap text-end pe-0 w-action">
                        <div class="font-sans-serif btn-reveal-trigger position-static">
                            <a class="dropdown-item text-danger" href="#">
                                <i class="far fa-trash-alt"></i>
                                Remove
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</section>
