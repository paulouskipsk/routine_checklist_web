<div class="row">
    <div class="col-12">
        <div class="card shadow-none border border-300 my-4">
            <div class="card-header p-4 border-bottom border-300 bg-soft">
                <div class="row g-3 justify-content-between align-items-center">
                    <div class="col-12 col-md">
                        <h4 class="text-900 mb-0">
                            Configurações do Checklist
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body py-5">
                <form action="{{ $action }}" method="{{ $method }}" role="form">
                    @csrf

                    <div class="row d-flex justify-content-center">
                        <div class="col-8">
                            <label for="description">Descrição<span class="text-danger">*</span></label>
                            <div class="input-group is-invalid">
                                <input type="text" id="description"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{ old('description') ?? @$sector->description }}" required>
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="status">Status<span class="text-danger">*</span></label>
                            <select id="status" class="form-select @error('status') is-invalid @enderror"
                                name="status" required>
                                <option selected disabled>Selecione...</option>
                                <option value="A"
                                    {{ old('status') == 'A' || @$sector->status == 'A' ? 'selected' : '' }}>Ativo
                                </option>
                                <option value="I"
                                    {{ old('status') == 'I' || @$sector->status == 'I' ? 'selected' : '' }}>Inativo
                                </option>

                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mt-3">
                        <div class="col-4">
                            <label for="random">Checklist é Aleatório?<span class="text-danger">*</span></label>
                            <select id="random" class="form-select @error('random') is-invalid @enderror"
                                name="random" required>
                                <option selected disabled>Selecione...</option>
                                <option value="true"
                                    {{ old('random') == 'true' || @$sector->random == 'true' ? 'selected' : '' }}>Sim
                                </option>
                                <option value="false"
                                    {{ old('random') == 'false' || @$sector->random == 'false' ? 'selected' : '' }}>Não
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="shelflife">Tempo de Vida (Em Minutos)<span class="text-danger">*</span></label>
                            <div class="input-group is-invalid">
                                <input type="number" id="shelflife"
                                    class="form-control @error('shelflife') is-invalid @enderror" name="shelflife"
                                    value="{{ old('shelflife') ?? @$sector->shelflife }}" required>
                            </div>
                            @error('shelflife')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="generate_time">Hora de Geração</label>
                            <div class="input-group is-invalid">
                                <input type="time" id="generate_time"
                                    class="form-control @error('generate_time') is-invalid @enderror"
                                    name="generate_time" value="{{ old('generate_time') ?? @$sector->generate_time }}"
                                    required>
                            </div>
                            @error('generate_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mt-5">
                        <div class="col-8">
                            <label for="chcl_id">Classificação</label>
                            <select id="chcl_id" class="form-select @error('chcl_id') is-invalid @enderror"
                                name="chcl_id" data-choices="data-choices" required>
                                @if (count($classifications) > 0)
                                    <option selected disabled>Selecione...</option>

                                    @foreach ($classifications as $class)
                                        <option value="{{ $class->id }}"
                                            {{ old('chcl_id') == $class->id || @$class->chcl_id == $class->id ? 'selected' : '' }}>
                                            {{ $class->description }}</option>
                                    @endforeach
                                @else
                                    <option value="" selected disabled>Nenhuma Classificação Cadastrada</option>
                                @endif

                            </select>
                            @error('chcl_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="frequency">Frequência<span class="text-danger">*</span></label>
                            <select id="frequency" class="form-select @error('frequency') is-invalid @enderror"
                                name="frequency" required>
                                <option selected disabled>Selecione...</option>
                                @foreach (Frequency::options() as $frequencyKey => $frequencyValue)
                                    <option value="{{ $frequencyValue }}"
                                        {{ old('frequency') == $frequencyValue || @$sector->frequency == $frequencyValue ? 'selected' : '' }}>
                                        {{ Frequency::getDescription($frequencyValue) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center">
                        <div class="col-12" id="frequency_composition"></div>
                    </div>

                    <div class="row d-flex justify-content-center mt-5">
                        <div class="col-2">
                            <button type="submit" class="btn btn-success mt-1 mb-4 w-100">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('postscript')
    <script type="text/javascript">
        $(document).ready(function() {

            $('#frequency').on('change', function() {
                let frequencySelected = $('#frequency').val();
                var html =
                    '<label class="mb-0 mt-5" for="randon">Especificação da Frêquencia<span class="text-danger mr-3">*</span></label>';
                switch (frequencySelected) {
                    case 'W':
                        html +=
                            "<span class='text-primary ml-2'>&nbsp;(Selecione o(s) Dia(s) da Semana)</span>";
                        html += "<div class='row d-flex mt-3'><div class='col-12'>";

                        html += "<div class='form-check form-check-inline'>" +
                            "<input class='form-check-input' type='checkbox' name='frequency_composition[]' value='0' />" +
                            "<label class='form-check-label' for='frequency_composition'>Domingo</label>" +
                            "</div>" +
                            "<div class='form-check form-check-inline'>" +
                            "<input class='form-check-input' type='checkbox' name='frequency_composition[]' value='1' />" +
                            "<label class='form-check-label' for='frequency_composition'>Segunda-Feira</label>" +
                            "</div>" +
                            "<div class='form-check form-check-inline'>" +
                            "<input class='form-check-input' type='checkbox' name='frequency_composition[]' value='2' />" +
                            "<label class='form-check-label' for='frequency_composition'>Terça-Feira</label>" +
                            "</div>" +
                            "<div class='form-check form-check-inline'>" +
                            "<input class='form-check-input' type='checkbox' name='frequency_composition[]' value='3' />" +
                            "<label class='form-check-label' for='frequency_composition'>Quarta-Feira</label>" +
                            "</div>" +
                            "<div class='form-check form-check-inline'>" +
                            "<input class='form-check-input' type='checkbox' name='frequency_composition[]' value='4' />" +
                            "<label class='form-check-label' for='frequency_composition'>Quinta-Feira</label>" +
                            "</div>" +
                            "<div class='form-check form-check-inline'>" +
                            "<input class='form-check-input' type='checkbox' name='frequency_composition[]' value='5' />" +
                            "<label class='form-check-label' for='frequency_composition'>Sexta-Feira</label>" +
                            "</div>" +
                            "<div class='form-check form-check-inline'>" +
                            "<input class='form-check-input' type='checkbox' name='frequency_composition[]' value='6' />" +
                            "<label class='form-check-label' for='frequency_composition'>Sábado</label>" +
                            "</div>";

                        html += "</div></div>";

                        $('#frequency_composition').html(html);
                        break;
                    case 'M':
                        html +=
                            "<span class='text-primary ml-2'>&nbsp;(Selecione o(s) Dia(s) do mês)</span>";
                        // html += "<div class='row d-flex'><div class='col-12'> &nbsp; (Selecione o(s) Dia(s) do mês) </div></div>";
                        for (let index = 1; index <= 31; index++) {
                            if (index == 1 || (index - 1) % 4 === 0) {
                                if (index > 1) html += "</div>";
                                html += "<div class='row d-flex'>";
                            }
                            html += "<div class='col-2'>" +
                                "<div class='form-check'>" +
                                "<input class='form-check-input' type='checkbox' name='frequency_composition[]' value='" +
                                index + "' />" +
                                "<label class='form-check-label' for='frequency_composition'>" + index +
                                "</label>" +
                                "</div>" +
                                "</div>";
                        }
                        $('#frequency_composition').html(html);
                        break;
                    default:
                        $('#frequency_composition').html('');
                        break;
                }
            })
        });
    </script>
@endsection





    {{-- <div class="row">
        <div class="col-12">
            <div class="card shadow-none border border-300 my-4" >
                <div class="card-header p-4 border-bottom border-300 bg-soft">
                    <div class="row g-3 justify-content-between align-items-center">
                        <div class="col-12 col-md">
                            <h4 class="text-900 mb-0 float-start">
                                Perguntas do Checklist
                            </h4>

                            <div class="float-end">
                                <button class="btn btn-sm py-1 px-3 btn-outline-primary"><i class="fas fa-plus"></i> Incluir Pergunta</button>  
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body py-5">
                    .... perguntas
                </div>
            </div>
        </div>
    </div> --}}