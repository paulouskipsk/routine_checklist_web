<form action="{{ $action }}" method="POST" role="form">
    @csrf
    @method("$method")

    <div class="row d-flex justify-content-center">
        <div class="col-6 mt-3">
            <label for="name">Nome<span class="text-danger">*</span></label> 
            <div class="input-group is-invalid">
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name') ?? @$user->name}}" required>
            </div>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-6 mt-3">
            <label for="lastname">Sobrenome<span class="text-danger">*</span></label> 
            <div class="input-group is-invalid">
                <input type="text" id="lastname" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{old('lastname') ?? @$user->lastname}}" required>
            </div>
            @error('lastname')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-6 mt-3">
            <label for="login">Login<span class="text-danger">*</span></label> 
            <div class="input-group is-invalid">
                <input type="text" id="login" class="form-control @error('login') is-invalid @enderror" name="login" value="{{old('login') ?? @$user->login}}" required>
            </div>
            @error('login')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-6 mt-3">
            <label for="email">Email</label> 
            <div class="input-group is-invalid">
                <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email') ?? @$user->email}}">
            </div>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="row d-flex justify-content-center mt-3">
        <div class="col-6">
            <label for="status">Status<span class="text-danger">*</span></label> 
            <select id="status" class="form-select @error('status') is-invalid @enderror" name="status" required>
                <option selected disabled>Selecione...</option>
                <option value="A" {{ old('status') == 'A' || @$user->status == 'A' ? 'selected': '' }}>Ativo</option>
                <option value="I" {{ old('status') == 'I' || @$user->status == 'I' ? 'selected': '' }}>Inativo</option>

            </select>
            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>


    <div class="row d-flex justify-content-center mt-3">
        <div class="col-6">

            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="access_admin" name="access_admin" {{$user->access_admin == 'S' ? 'checked' : ''}}/>
                <label class="form-check-label" for="flexSwitchCheckDefault">Usuário Administrador</label>
            </div>

            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="access_operator" name="access_operator" {{$user->access_operator == 'S' ? 'checked' : ''}}/>
                <label class="form-check-label" for="flexSwitchCheckDefault">Usuário Operador</label>
            </div>

            <div class="form-check form-switch mt-3">
                <input class="form-check-input" type="checkbox" id="access_mobile" name="access_mobile" {{$user->access_mobile == 'S' ? 'checked' : ''}}/>
                <label class="form-check-label" for="flexSwitchCheckDefault">Usuário Mobile (APP)</label>
            </div>
        </div>

    </div>

    <div class="row d-flex justify-content-center mt-3">
        <div class="col-2">
            <button type="submit" class="btn btn-success mt-1 mb-4 w-100">Salvar</button>
        </div>
    </div>
</form>