<div class="row">
    <div class="col-12">
        <div class="card shadow-none border border-300 my-4">
            <div class="card-header p-4 border-bottom border-300 bg-soft">
                <div class="row g-3 justify-content-between align-items-center">
                    <div class="col-12 col-md">
                        <h4 class="text-900 mb-0">
                            Configurações da Pergunta
                        </h4>
                    </div>
                </div>
            </div>
            <div class="card-body py-5">
                <form action="{{ $action }}" method="{{ $method }}" role="form">
                    @csrf

                    <input type="hidden" name="chkl_id" value="{{@$chkl_id}}">

                    <div class="row d-flex justify-content-center">
                        <div class="col-8">
                            <label for="description">Descrição<span class="text-danger">*</span></label>
                            <div class="input-group is-invalid">
                                <input type="text" id="description"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    value="{{ old('description') ?? @$chit->description }}" required>
                            </div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="status">Status<span class="text-danger">*</span></label>
                            <select id="status" class="form-select @error('status') is-invalid @enderror"
                                name="status" required>
                                <option value="A"
                                    {{ old('status') == 'A' || @$chit->status == 'A' ? 'selected' : '' }}>Ativo
                                </option>
                                <option value="I"
                                    {{ old('status') == 'I' || @$chit->status == 'I' ? 'selected' : '' }}>Inativo
                                </option>

                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="col-4 mt-4">
                            <label for="type">Tipo Pergunta<span class="text-danger">*</span></label>
                            <select id="type" class="form-select @error('type') is-invalid @enderror"
                                name="type" required>
                                <option value="A"
                                    {{ old('type') == 'A' || @$chit->type == 'A' ? 'selected' : '' }}>Avaliativa
                                </option>
                                <option value="S"
                                    {{ old('type') == 'S' || @$chit->type == 'S' ? 'selected' : '' }}>Sim/Não
                                </option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4 mt-4">
                            <label for="shelflife">Tempo de Vida (Em Minutos)<span class="text-danger">*</span></label>
                            <div class="input-group is-invalid">
                                <input type="number" id="shelflife"
                                    class="form-control @error('shelflife') is-invalid @enderror" name="shelflife"
                                    value="{{ old('shelflife') ?? @$chit->shelflife }}" required>
                            </div>
                            @error('shelflife')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4 mt-4">
                            <label for="sequence">Sequência<span class="text-danger">*</span></label>
                            <div class="input-group is-invalid">
                                <input type="number" id="sequence"
                                    class="form-control @error('sequence') is-invalid @enderror" name="sequence"
                                    value="{{ old('sequence') ?? @$chit->sequence }}" required>
                            </div>
                            @error('sequence')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4 mt-4">
                            <label for="score">Peso/Pontos<span class="text-danger">*</span></label>
                            <div class="input-group is-invalid">
                                <input type="number" id="score"
                                    class="form-control @error('score') is-invalid @enderror" name="score"
                                    value="{{ old('score') ?? @$chit->score }}" required>
                            </div>
                            @error('score')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4 mt-4">
                            <label for="required_photo">Fotos Obrigatoria?<span class="text-danger">*</span></label>
                            <select id="required_photo" class="form-select 
                                    @error('required_photo') is-invalid @enderror"
                                    name="required_photo" required>

                                <option value="N"
                                    {{ old('required_photo') == 'N' || @$chit->required_photo == 'N' ? 'selected' : '' }}>Não
                                </option>
                                <option value="S"
                                    {{ old('required_photo') == 'S' || @$chit->required_photo == 'S' ? 'selected' : '' }}>Sim
                                </option>
                                
                            </select>
                            @error('required_photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-4 mt-4">
                            <label for="quant_photo">Quant. Max. Fotos<span class="text-danger">*</span></label>
                            <div class="input-group is-invalid">
                                <input type="number" id="quant_photo"
                                    class="form-control @error('quant_photo') is-invalid @enderror" name="quant_photo">
                            </div>
                            @error('quant_photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-2 mt-4">
                            <label for="hour_min">Hora min.</label>
                            <div class="input-group is-invalid">
                                <input type="time" id="hour_min"
                                    class="form-control @error('hour_min') is-invalid @enderror"
                                    name="hour_min" value="{{ old('hour_min') ?? @$chit->hour_min }}"
                                    required>
                            </div>
                            @error('hour_min')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-2 mt-4">
                            <label for="hour_max">Hora max.</label>
                            <div class="input-group is-invalid">
                                <input type="time" id="hour_max"
                                    class="form-control @error('hour_max') is-invalid @enderror"
                                    name="hour_max" value="{{ old('hour_max') ?? @$chit->hour_max }}"
                                    required>
                            </div>
                            @error('hour_max')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-6 mt-4">
                            <label for="sect_id">Setor</label>
                            <select id="sect_id" class="form-select @error('sect_id') is-invalid @enderror"
                                name="sect_id" data-choices="data-choices">
                                @if (count($sectors) > 0)
                                    <option value="" selected>Selecione...</option>

                                    @foreach ($sectors as $sector)
                                        <option value="{{ $sector->id }}"
                                            {{ old('sect_id') == $sector->id || @$chit->sect_id == $sector->id ? 'selected' : '' }}>
                                            {{ $sector->description }}</option>
                                    @endforeach
                                @else
                                    <option value=" " selected>Nenhum Setor Cadastrado</option>
                                @endif

                            </select>
                            @error('sect_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
        let quantPhoto = <?= isset($chit?->quant_photo) ? $chit->quant_photo : 0 ?>;

        function requiredPhoto(){
            let value = $('#required_photo').val();
            if(value =='S'){
                $('#quant_photo').attr("readonly", false);
                $('#quant_photo').val(quantPhoto);
            }else{
                $('#quant_photo').val(1);
                $('#quant_photo').attr("readonly", true);
            }
        }

        $(document).ready(function() {
            requiredPhoto();

            $('#required_photo').on('change', function() {
                requiredPhoto();
            });
        });
    </script>
@endsection