<form action="{{ $action }}" method="POST" role="form">
    @csrf
    @method("$method")

    <input type="hidden" id="users_selecteds" name="users_selecteds">

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-6">
            <label for="name">Nome<span class="text-danger">*</span></label> 
            <div class="input-group is-invalid">
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name') ?? @$userGroup->name}}" required>
            </div>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-3">
            <label for="status">Status<span class="text-danger">*</span></label> 
            <select id="status" class="form-select @error('status') is-invalid @enderror" name="status" required>
                <option value="A" {{ old('status') == 'A' || @$userGroup->status == 'A' ? 'selected': '' }}>Ativo</option>
                <option value="I" {{ old('status') == 'I' || @$userGroup->status == 'I' ? 'selected': '' }}>Inativo</option>

            </select>
            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-3 mb-3">
            <a class="btn btn-outline-success btn-sm mt-4" data-bs-toggle="modal" data-bs-target="#include-user">
                <i class="fas fa-plus"></i>
                Incluir Usuário
            </a>
        </div>
    
    </div>

    <hr/>

    <div class="table-responsive mh-300 mt-5">
        <table class="table table-striped table-sm fs--1 mb-0" id="user-group-users">
            <thead class="mt-5">
                <tr>
                    <th class="sort border-top fs-0 ps-3 w-id" data-sort="id">Cod. usuário</th>
                    <th class="sort border-top fs-0" data-sort="name">Nome usuário</th>
                    <th class="sort text-middle align-middle fs-0 pe-0 border-top" scope="col">Ações</th>
                </tr>
            </thead>
            
            <tbody class="list"></tbody>
        </table>
    </div>


    <div class="row d-flex justify-content-center mt-5">
        <div class="col-2">
            <button type="submit" class="btn btn-success mt-1 mb-4 w-100">Salvar</button>
        </div>
    </div>
    
</form>

@includeIf('registrations.user-group._include-user-modal')    


@section('postscript')
    <script type="text/javascript">
        $(document).ready(() => {
            let usersSelectedsObj = null;
            var users = <?= json_encode(@$userGroup->users) ?>;
            loadUsersTable(users);
            loadUsersField(users);

            $('#btn-add-users-selecteds').on('click', function(){
                includeUsersSelecteds();
            });

            $('#user-group-users tbody').on('click', 'div.remove-user', function () {
                let userId = $(this).data('user-id').toString();
                let usersSelecteds = $("#users_selecteds").val().split(',');
                usersSelecteds.splice(usersSelecteds.indexOf(userId), 1);
                $("#users_selecteds").val(usersSelecteds);

                let table = $('#user-group-users').DataTable();
                table
                    .row( $(this).parents('tr') )
                    .remove()
                    .draw();
            } );

            $('#user-search').on('keyup', function() {
                let userSearchVal = $(this).val();
                if (userSearchVal.length > 1){
                    $.ajax({
                        'processing': true,
                        'serverSide': false,
                        type: "GET",
                        url: "/usuario/buscar-por-nome",
                        data: {
                            name: userSearchVal
                        },
                        success: function(users) {
                            usersSelectedsObj = users;
                            let data = [];
                            users.forEach(user => {
                                var line = "<li class='list-group-item'>";
                                line += "<input type='checkbox' class='form-check-input me-1' name='users-selecteds' value='"+ user.id +"' data-user-name='"+ user.name +"'>";
                                line += user.id +" - "+user.name +"</li>";
                                data.push(line);
                            });
                            $('#user-searched').html(data);
                        }
                    });
                }else{
                    $('#user-searched').html(["<li class='list-group-item'> Sem Dados para Exibir</li>"]);
                }
            });
        });

        function loadUsersField(users) {
            let userIds = [];
            users?.forEach(user => {
                userIds.push(user.id);
            });

            userIds = arrayUnique(userIds);
            $("#users_selecteds").val(userIds);
        }

        function loadUsersTable(users) {
            let table = $('#user-group-users').DataTable();
            idsInTbale = [];

            document.querySelectorAll('#user-group-users tbody tr').forEach(line => {
                idsInTbale.push(line.children[0].textContent);
            });
   
            users?.forEach(user => {
                if(!idsInTbale.includes(user.id)){
                    table.row.add([
                        user.id, 
                        user.name,  
                        "<div class='dropdown-item text-danger remove-user cursor-pointer' data-user-id='"+ user.id +"'> <i class='far fa-trash-alt'></i>&nbsp;Remove</div>"
                    ]).draw(false);
                }
            });
            table.draw();            
        }

        function includeUsersSelecteds(){
            let checkboxes = document.querySelectorAll('[name=users-selecteds]:checked');
            let usersSelectedsIds = [];
            let users = [];
            checkboxes.forEach(checkbox => {
                usersSelectedsIds.push(checkbox.value);
                users.push({
                    id: checkbox.value,
                    name: checkbox.getAttribute("data-user-name")
                });
            });

            if(usersSelectedsIds.length > 0 ){
                let usersSelecteds = $("#users_selecteds").val();
                usersSelecteds = usersSelecteds?.length <= 0 ? [] : usersSelecteds.split(",");
                usersSelecteds = arrayMerge(usersSelecteds, usersSelectedsIds);
                usersSelecteds = arrayUnique(usersSelecteds);
                $("#users_selecteds").val(usersSelecteds);
                loadUsersTable(users);
            }
        }

        function arrayUnique(array) { return [...new Set(array)]; }

        function arrayMerge(array1, array2){
            Array.prototype.push.apply(array1, array2);
            return array1;
        }
    </script>
@endsection