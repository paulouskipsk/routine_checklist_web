<form action="{{ $action }}" method="POST" role="form">
    @csrf
    @method("$method")

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-4">
            <label for="fantasy_name">Nome Fantasia<span class="text-danger">*</span></label>
            <div class="input-group is-invalid">
                <input type="text" id="fantasy_name" class="form-control @error('fantasy_name') is-invalid @enderror"
                    name="unity[fantasy_name]" value="{{ old('fantasy_name') ?? @$unity->fantasy_name }}" required>
            </div>
            @error('fantasy_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-5">
            <label for="corporate_name">Razão Social<span class="text-danger">*</span></label>
            <div class="input-group is-invalid">
                <input type="text" id="corporate_name"
                    class="form-control @error('corporate_name') is-invalid @enderror" name="unity[corporate_name]"
                    value="{{ old('corporate_name') ?? @$unity->corporate_name }}">
            </div>
            @error('corporate_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-3">
            <label for="status">Status<span class="text-danger">*</span></label>
            <select id="status" class="form-select @error('status') is-invalid @enderror" name="unity[status]" required>
                <option value="A" {{ old('status') == 'A' || @$unity->status == 'A' ? 'selected' : '' }}>Ativo
                </option>
                <option value="I" {{ old('status') == 'I' || @$unity->status == 'I' ? 'selected' : '' }}>Inativo
                </option>

            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-4">
            <label for="cnpj">CNPJ<span class="text-danger">*</span></label>
            <div class="input-group is-invalid">
                <input type="text" id="cnpj" class="form-control @error('cnpj') is-invalid @enderror"
                    name="unity[cnpj]" value="{{ old('cnpj') ?? @$unity->cnpj }}">
            </div>
            @error('cnpj')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-4">
            <label for="state_registration">Inscrição Estadual<span class="text-danger">*</span></label>
            <div class="input-group is-invalid">
                <input type="text" id="state_registration"
                    class="form-control @error('state_registration') is-invalid @enderror" name="unity[state_registration]"
                    value="{{ old('state_registration') ?? @$unity->state_registration }}">
            </div>
            @error('state_registration')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-4">
            <label for="phone_fixed">Telefone Fixo<span class="text-danger">*</span></label>
            <div class="input-group is-invalid">
                <input type="text" id="phone_fixed" class="form-control @error('phone_fixed') is-invalid @enderror"
                    name="unity[phone_fixed]" value="{{ old('phone_fixed') ?? @$unity->phone_fixed }}">
            </div>
            @error('phone_fixed')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="text-primary mt-5">Endereço</div>
    <hr />

    <div class="row d-flex justify-content-center mt-4">
        <div class="col-5">
            <label for="street_name">Nome da Rua<span class="text-danger">*</span></label>
            <div class="input-group is-invalid">
                <input type="text" id="street_name" class="form-control @error('street_name') is-invalid @enderror"
                    name="address[street_name]" value="{{ old('street_name') ?? @$unity->address->street_name }}" required>
            </div>
            @error('street_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-2">
            <label for="number">Número<span class="text-danger">*</span></label>
            <div class="input-group is-invalid">
                <input type="number" id="number" class="form-control @error('number') is-invalid @enderror"
                    name="address[number]" value="{{ old('number') ?? @$unity->address->number }}" required>
            </div>
            @error('number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-5">
            <label for="neighborhood">Bairro<span class="text-danger">*</span></label>
            <div class="input-group is-invalid">
                <input type="text" id="neighborhood" class="form-control @error('neighborhood') is-invalid @enderror"
                    name="address[neighborhood]" value="{{ old('neighborhood') ?? @$unity->address->neighborhood }}" required>
            </div>
            @error('neighborhood')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="row d-flex justify-content-center mt-4">
        <div class="col-3">
            <label for="cep">CEP<span class="text-danger">*</span></label>
            <div class="input-group is-invalid">
                <input type="text" id="cep" class="form-control @error('cep') is-invalid @enderror"
                    name="address[cep]" value="{{ old('cep') ?? @$unity->address->cep }}" required>
            </div>
            @error('cep')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="col-3">
            <label for="complement">Complemento<span class="text-danger">*</span></label>
            <div class="input-group is-invalid">
                <input type="text" id="complement" class="form-control @error('complement') is-invalid @enderror"
                    name="address[complement]" value="{{ old('complement') ?? @$unity->address->complement }}" required>
            </div>
            @error('complement')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-6">
            <label for="city">Cidade<span class="text-danger">*</span></label>
            <select id="city" class="form-select @error('city') is-invalid @enderror" name="address[city_id]" required>
                @if($method == 'put')
                <option value="{{@$unity->address->city->id}}">{{@($unity->address->city->name ."/".$unity->address->city->state->acronym)}}</option>
                @endif
            </select>
            @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-2">
            <button type="submit" class="btn btn-success mt-1 mb-4 w-100">Salvar</button>
        </div>
    </div>
</form>

@section('postscript')
    <script type="text/javascript">

        $(document).ready(() => {
            $("#city").select2({
                minimumInputLength: 2,
                theme: "bootstrap-5",
                ajax: {
                    url: "/cidade/buscar-por-nome",
                    dataType: "json",
                    delay: 300,
                    cache: true,
                    data: function(params) {
                        return {
                            search: params.term,
                            uf: $("#state").val(),
                        };
                    },
                    processResults: function(data) {
                        if (data.length === 0) {
                            return {
                                results: [{
                                    id: "__nenhum_encontrado__",
                                    text: "Nenhum resultado encontrado",
                                }, ],
                            };
                        }
                        var options = [];
                        $.each(data, function(index, city) {
                            console.log(city)
                            options.push({
                                id: city.id,
                                text: city.name +"/"+city.state.acronym
                            });
                        });
                        return {
                            results: options,
                        };
                    },
                },
                placeholder: "Digite o nome da cidade",
                escapeMarkup: function(markup) {
                    return markup;
                },
                minimumResultsForSearch: 1,
                language: {
                    searching: function() {
                        return "Buscando...";
                    },
                    inputTooShort: function() {
                        return "Digite 2 ou mais caracteres para buscar";
                    },
                    noResults: function() {
                        return "Nenhum resultado encontrado";
                    },
                },
            });
        });
    </script>
@endsection
