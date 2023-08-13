<form action="{{ $action }}" method="{{$method}}" role="form">
    @csrf

    <div class="row d-flex justify-content-center">
        <div class="col-6">
            <label for="description">Descrição<span class="text-danger">*</span></label> 
            <div class="input-group is-invalid">
                <input type="text" id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{old('description') ?? @$classification->description}}" required>
            </div>
            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-6">
            <label for="status">Status<span class="text-danger">*</span></label> 
            <select id="status" class="form-select @error('status') is-invalid @enderror" name="status" required>
                <option selected disabled>Selecione...</option>
                <option value="A" {{ old('status') == 'A' || @$classification->status == 'A' ? 'selected': '' }}>Ativo</option>
                <option value="I" {{ old('status') == 'I' || @$classification->status == 'I' ? 'selected': '' }}>Inativo</option>

            </select>
            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-2">
            <button type="submit" class="btn btn-success mt-1 mb-4 w-100">Salvar</button>
        </div>
    </div>
</form>