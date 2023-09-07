<div class="row">
    <div class="col-12">
        <div class="card shadow-none border border-300 my-4">
            <div class="card-header p-4 border-bottom border-300 bg-200">
                <div class="row g-3 justify-content-between align-items-center">
                    <div class="col-12 col-md">
                        <h4 class="text-900 mb-0">
                            Configurações do Checklist
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body py-5">
                <form action="{{ $action }}" method="POST" role="form">
                    @csrf
                    @method("$method")

                    <div class="row d-flex justify-content-center">
                        <div class="col-6">
                            <label for="description">Descrição<span class="text-danger">*</span></label>
                            <div class="input-group is-invalid">
                                <input type="text" id="description"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{ old('description') ?? @$checklist->description }}" required>
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-3">
                            <label for="status">Status<span class="text-danger">*</span></label>
                            <select id="status" class="form-select @error('status') is-invalid @enderror"
                                name="status" required>
                                <option value="A"
                                    {{ old('status') == 'A' || @$checklist->status == 'A' ? 'selected' : '' }}>Ativo
                                </option>
                                <option value="I"
                                    {{ old('status') == 'I' || @$checklist->status == 'I' ? 'selected' : '' }}>Inativo
                                </option>

                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-3">
                            <label for="chkl_type">Tipo de Checklist<span class="text-danger">*</span></label>
                            <select id="chkl_type" class="form-select @error('chkl_type') is-invalid @enderror" name="chkl_type" required>
                                <option value="N"
                                {{ old('chkl_type') == 'N' || @$checklist->chkl_type == 'N' ? 'selected' : '' }}>Padrão
                                </option>
                                <option value="A"
                                    {{ old('chkl_type') == 'A' || @$checklist->chkl_type == 'A' ? 'selected' : '' }}>Aleatório
                                </option>
                            </select>
                            @error('chkl_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row d-flex justify-content-center mt-3">
                        

                        <div class="col-2">
                            <label for="shelflife">Shelflife (Em Minutos)<span class="text-danger">*</span></label>
                            <div class="input-group is-invalid">
                                <input type="number" id="shelflife"
                                    class="form-control @error('shelflife') is-invalid @enderror" name="shelflife"
                                    value="{{ old('shelflife') ?? @$checklist->shelflife ?? '1'}}" required>
                            </div>
                            @error('shelflife')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-2">
                            <label for="generate_time">Hora de Geração</label>
                            <div class="input-group is-invalid">
                                <input type="time" id="generate_time"
                                    class="form-control @error('generate_time') is-invalid @enderror"
                                    name="generate_time" value="{{ old('generate_time') ?? @$checklist->generate_time ?? '00:00'}}"
                                    required>
                            </div>
                            @error('generate_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="chcl_id">Classificação</label>
                            <select id="chcl_id" class="form-select @error('chcl_id') is-invalid @enderror"
                                name="chcl_id" data-choices="data-choices" required>
                                @if (count($classifications) > 0)
                                    <option value="" selected>Selecione...</option>

                                    @foreach ($classifications as $class)
                                        <option value="{{ $class->id }}"
                                            {{ old('chcl_id') == $class->id || @$checklist->chcl_id == $class->id ? 'selected' : '' }}>
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
                                @foreach (Frequency::options() as $frequencyKey => $frequencyValue)
                                    <option value="{{ $frequencyValue }}"
                                        {{ old('frequency') == $frequencyValue || @$checklist->frequency == $frequencyValue ? 'selected' : '' }}>
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
                        <div class="col-12">
                            <select multiple="multiple" size="{{sizeof($units) < 5 ? 4 : 10}}" name="units[]" id="chkl-units">
                                @foreach ($units as $unity)
                                    <option value="{{$unity->id}}" 
                                        {{ @$checklist->units->contains('id', $unity->id) ? 'selected' : '' }}>
                                        {{"$unity->id - $unity->fantasy_name"}}
                                    </option>                            
                                @endforeach
                            </select>
                        </div>                        
                    </div>

                    <div class="row d-flex justify-content-center mt-5">
                        <div class="col-12">
                            <select multiple="multiple" size="{{sizeof($usersGroups) < 5 ? 4 : 10}}" name="usersGroups[]" id="users-groups">
                                @foreach ($usersGroups as $usersGroup)
                                    <option value="{{$usersGroup->id}}" 
                                        {{ old('usersGroups') != null && in_array(strVal($usersGroup->id), old('usersGroups')) || 
                                        @$checklist->usersGroups->contains('id', $usersGroup->id) ? 'selected' : '' }}>
                                        {{"$usersGroup->id - $usersGroup->name"}}
                                    </option>                            
                                @endforeach
                            </select>
                        </div>                        
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
    
        function getFrequencyByMonth(selectedDays){
            let html = "<span class='text-primary ml-2'>&nbsp;(Selecione o(s) Dia(s) do mês)</span>";
            let isChecked = '';

            for (let index = 1; index <= 31; index++) {
                if (index == 1 || (index - 1) % 4 === 0) {
                    if (index > 1) html += "</div>";
                    html += "<div class='row d-flex'>";
                }

                isChecked = selectedDays.includes(index.toString()) ? 'checked' : '';
                html += "<div class='col-2'>" +
                            "<div class='form-check'>" +
                                "<input class='form-check-input' type='checkbox' name='frequency_composition[]' value='" + index + "'"+ isChecked +" />" +
                                "<label class='form-check-label' for='frequency_composition'>" + index + "</label>" +
                            "</div>" +
                        "</div>";
            }
            return html;
        }

        function getFrequencyByWeek(selectedDays){
            let days = ['Domingo','Segunda-Feira','Terça-Feira','Quarta-Feira','Quinta-Feira','Sexta-Feira','Sábado'];
            let html = "<span class='text-primary ml-2'>&nbsp;(Selecione o(s) Dia(s) da Semana)</span>";
            html += "<div class='row d-flex'><div class='col-12'>";
            let isChecked = '';

            days.forEach(function(day, index){
                isChecked = selectedDays.includes(index.toString()) ? 'checked' : '';
                html += "<div class='form-check form-check-inline'>" +
                            "<input class='form-check-input' type='checkbox' name='frequency_composition[]' value='"+ index + "'"+ isChecked +" />" +
                            "<label class='form-check-label' for='frequency_composition'>"+ day +"</label>" +
                        "</div>";
            });
            html += "</div></div>";
            return html;
        }

        function getFrequencies(selectedDays){
            let frequencySelected = $('#frequency').val();
            let html ='<label class="mb-0 mt-5 mb-3" for="frequency_composition">Especificação da Frêquencia<span class="text-danger mr-3">*</span></label>';

            switch (frequencySelected) {
                case 'W':
                    $('#frequency_composition').html(html + getFrequencyByWeek(selectedDays));
                    break;
                case 'M':
                    $('#frequency_composition').html(html + getFrequencyByMonth(selectedDays));
                    break;
                default:
                    $('#frequency_composition').html('');
                    break;
            }
        }

        $(document).ready(function() {
            let selectedDays = <?= json_encode(@$checklist->frequency_composition) ?>;
            let frequency = <?= json_encode(@$checklist->frequency) ?>;
            getFrequencies(selectedDays);


            var dualListBox = $('#chkl-units').bootstrapDualListbox({
                nonSelectedListLabel: 'Unidades Ativas',
                selectedListLabel: 'Unidades Selecionadas',
                preserveSelectionOnMove: 'moved',
                moveAllLabel: 'Mover Todas',
                removeAllLabel: 'Remover Todas',
                infoText: 'Exibir todos {0}',
                infoTextEmpty: "Lista vazia",
                filterTextClear: '<span class="text-primary">Mostrar Tudo</span>',
                filterPlaceHolder: 'Filtro',
                infoTextFiltered: '<span class="label label-warning">Filtrando</span> {0} de {1}',
            });

            var dualListBox = $('#users-groups').bootstrapDualListbox({
                nonSelectedListLabel: 'Gr. Usuários Ativos',
                selectedListLabel: 'Gr. Usuários Selecionados',
                preserveSelectionOnMove: 'moved',
                moveAllLabel: 'Mover Todos',
                removeAllLabel: 'Remover Todos',
                infoText: 'Exibir todos {0}',
                infoTextEmpty: "Lista vazia",
                filterTextClear: '<span class="text-primary">Mostrar Tudo</span>',
                filterPlaceHolder: 'Filtro',
                infoTextFiltered: '<span class="label label-warning">Filtrando</span> {0} de {1}',
            });


            $('#frequency').on('change', function() {
                data = [];
                if($('#frequency').val() === frequency){
                    data = selectedDays;
                }
                getFrequencies(data);
            });            
        });
    </script>
@endsection