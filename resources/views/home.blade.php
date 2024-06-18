@extends('layouts.template')

@section('content')

    <div class="accordion">
        <div class="accordion-item mx-n6 px-4 py-2">
            <h2 class="accordion-header">
                <button class="accordion-button" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#panelsStayOpen-collapseOne"
                        aria-expanded="true" 
                        aria-controls="panelsStayOpen-collapseOne">
                    Filtros
                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <div class="accordion-body">

                    <form action="{{route('home')}}" method="GET" role="form" class="container">
                        @csrf
                        @method('GET')

                        <div class="row">
                            <div class="col-xs-12 col-md-2 mx-0 px-1">
                                <label class="form-label" for="datepicker">Data Inicial</label>
                                <input 
                                    class="form-control datetimepicker" 
                                    id="start_date" 
                                    name="start_date" 
                                    value="{{$startDate->format('d/m/Y')}}"
                                    type="text" 
                                    placeholder="dd/mm/yyyy" 
                                    data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' />
                            </div>

                            <div class="col-xs-12 col-md-2 mx-0 px-1">
                                <label class="form-label" for="datepicker">Data Final</label>
                                <input 
                                    class="form-control datetimepicker" 
                                    id="start_date" 
                                    value="{{$endDate->format('d/m/Y')}}"
                                    name="end_date" 
                                    type="text" 
                                    placeholder="dd/mm/yyyy" 
                                    data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' />
                            </div>

                            <div class="col-xs-12 col-md-8 mx-0 px-1">
                                <label class="form-label" for="datepicker">Unidades Selecionadas</label>
                                <div class="input-group mb-3">
                                    <button class="btn btn-outline-secondary" 
                                            type="button"
                                            onclick="getSelectUnitsModal(this)"
                                            data-checklist-units="{{ $units->pluck('id') }}"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#select-units-modal"
                                            type="button"
                                            id="select-units">
                                            Selecionar
                                    </button>
                                    <input type="text" 
                                        name="units" 
                                        value="{{Functions::formatIdsUnits($unitsSelecteds)}}" 
                                        id="units-selecteds-input" 
                                        class="form-control" 
                                        placeholder="Não há unidades Selecionadas">
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-xs-12 col-md-8 text-end mx-0 px-0">
                                <button class="btn btn-outline-success " type="submit">
                                    <i class="fa-solid fa-check-double"></i>
                                    Aplicar Filtro
                                </button> 
                            </div>
                        </div>

                    </form>
                </div><em></em>
            </div>
        </div>
    </div>

    <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-white py-3 mt-2 border-1 border-y">
        <h5 class="text-primary text-center">Resumo de execução dos checklists finalizados</h5>

        <div class="row mb-6 mt-3">
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2 m-0 p-2 text-center border border-1 card-home">
                <i class="fa-regular fa-star text-info fs-3 lh-1"></i>
                <h1 class="fs-3 pt-3">{{$reports['finishedTotals']['totals']['scoreTotal']}}</h1>
                <p class="fs--1 mb-0">Pontuação Processada</p>
                <p class="mt-1 text-info">
                    Questões Geradas: 
                    <span class="fw-bold">
                        {{$reports['finishedTotals']['totals']['questionsTotals']}}
                    </span>
                </p>
            </div>
  
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2 m-0 p-2 text-center border border-1 card-home">
                <i class="fa-solid fa-star text-primary fs-3 lh-1"></i>
                <h1 class="fs-3 pt-3">{{$reports['finishedTotals']['totals']['scoreRun']}}</h1>
                <p class="fs--1 mb-0">Pontuação Alcançada</p>

                <div class="progress mt-1 b-0" style="height:5px;">
                    <div role="progressbar" 
                         aria-valuemax="100"     
                         aria-valuenow="25" 
                         aria-valuemin="0" 
                         style="width: {{$reports['finishedTotals']['percentages']['percentScoreRun']}}%" 
                         class="progress-bar bg-{{$reports['finishedTotals']['percentages']['percentScoreRun'] < 70 ? 'danger' : 'success'}}">
                    </div>
                </div>
                {{round($reports['finishedTotals']['percentages']['percentScoreRun'], 3)}}%
            </div>
  
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2 m-0 p-2 text-center border border-1 card-home">
                <i class="fa-regular fa-circle-check text-success fs-3 lh-1"></i>
                <h1 class="fs-3 pt-3">{{$reports['finishedTotals']['totals']['questionsExecuted']}}</h1>
                <p class="fs--1 mb-0">Questões Respondidas</p>

                <div class="progress mt-1" style="height:5px">
                    <div 
                        role="progressbar" 
                        aria-valuenow="25" 
                        aria-valuemin="0" 
                        aria-valuemax="100"
                        style="width: {{$reports['finishedTotals']['percentages']['percentQuestionsExecuted']}}%"
                        class="progress-bar bg-{{$reports['finishedTotals']['percentages']['percentQuestionsExecuted']}} < 70 ? 'danger' : 'success'}}" >
                    </div>
                </div>
                {{round($reports['finishedTotals']['percentages']['percentQuestionsExecuted'], 3)}}%
            </div>
  
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2 m-0 p-2 text-center border border-1 card-home">
              <i class="fa-solid fa-triangle-exclamation text-danger fs-3 lh-1"></i>
              <h1 class="fs-3 pt-3">{{$reports['finishedTotals']['totals']['questionsLost']}}</h1>
              <p class="fs--1 mb-0">Questões não Respondidas</p>

              <div class="progress mt-1" style="height:5px">
                <div role="progressbar" 
                     aria-valuenow="25" 
                     aria-valuemin="0" 
                     aria-valuemax="100"
                     class="progress-bar bg-primary"
                     style="width: {{$reports['finishedTotals']['percentages']['percentQuestionsLost']}}%" >
                </div>
            </div>
            {{round($reports['finishedTotals']['percentages']['percentQuestionsLost'],3)}}%
            </div>
  
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2 m-0 p-2 text-center border border-1 card-home">
                <i class="far fa-thumbs-down text-warning fs-3 lh-1"></i>
                <h1 class="fs-3 pt-3">{{$reports['finishedTotals']['totals']['questionsNegatives']}}</h1>
                <p class="fs--1 mb-0">Questões Não/Ruim</p>

                <div class="progress mt-1" style="height:5px">
                    <div role="progressbar" 
                         aria-valuenow="25" 
                         aria-valuemin="0" 
                         aria-valuemax="100"
                         style="width: {{$reports['finishedTotals']['percentages']['percentQuestionsNegatives']}}%" 
                         class="progress-bar bg-primary">
                    </div>
                </div>
                {{round($reports['finishedTotals']['percentages']['percentQuestionsNegatives'], 3)}}%
            </div>

            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2 m-0 p-2 text-center border border-1 card-home">
                <i class="far fa-thumbs-up text-success fs-3 lh-1"></i>
                <h1 class="fs-3 pt-3">{{$reports['finishedTotals']['totals']['questionsAfirmatives']}}</h1>
                <p class="fs--1 mb-0">Questões Sim/Bom/Excel.</p>

                <div class="progress mt-1" style="height:5px">
                    <div aria-valuenow="25" 
                         aria-valuemin="0" 
                         aria-valuemax="100"
                         role="progressbar" 
                         class="progress-bar bg-primary" 
                         style="width: {{$reports['finishedTotals']['percentages']['percentQuestionsAfirmatives']}}%" >
                    </div>
                </div>
                {{round($reports['finishedTotals']['percentages']['percentQuestionsAfirmatives'], 3)}}%
            </div>
  
          </div>
    </div>

    <div class="mx-n4 pr-1 mx-lg-n6 mt-5">
        <div class="row">
            <div class="col-12">
                <div class="chart-bar-home d-flex justify-content-center pb-4"></div>
                <div class="mx-auto vh-50" id="chart_bar"></div>
            </div>
        </div>
    </div>


  <!-- Modal -->
  <div class="modal modal-lg fade" id="select-units-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Selecionar Unidades para o filtro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="units-selecteds">

                <div class="row d-flex justify-content-center mt-5">
                    <div class="col-12" id="select-unity-for-filter"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-confirm">Confirmar</button>
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->
@endsection

@section('postscript')
    <script type="text/javascript">
        let reports = <?= json_encode($reports) ?>;
        let units = <?= json_encode($units->pluck('id')) ?>;
        let unitsSelecteds = <?= json_encode($unitsSelecteds) ?>;
        let dataSource = [];

        function generateBarChart(){
            Object.keys(reports.checklistByUnityAndStatus).forEach((unitId) => {
                let values = reports.checklistByUnityAndStatus[unitId];
                dataSource.push({
                    'resultados': ('000'+unitId).slice(-3),
                    'Em Execução': values.active, 
                    'Perdidos/Parciais': values.incomplete, 
                    'Processados': values.completed
                }) 
            });

            let chartBar = echarts.init(document.getElementById('chart_bar'));
            
            let option = {
                width: 'auto',
                height: 'auto',
                title: {
                    text: 'Execução dos checklists por empresa',
                    left: 'center',
                    textStyle: {
                        fontSize: 18,
                        color: '#3874ff',
                    },
                },
                color: ["#45a1d6", "#eb4034", "#18d61b"],
                legend: {
                    bottom: '0%',
                    padding: 0,
                    itemWidth : 10,
                    itemHeight: 10
                },
                grid: {
                    top: '25%',
                },
                toolbox: {
                    show: true,
                    orient: 'vertical',
                    top: '30%',
                    left: '91%',
                    itemGap : 15,
                    itemSize: 20,
                    showTitle: true,
                    feature: {
                        mark: { show: true },
                        magicType: {
                            show: true,
                            type: ['line', 'bar', 'stack'],
                            title:{
                                stack: "Agrupar Dados",
                                tiled: 'Desagrupar Dados',
                                bar: "Gráfico em Colunas",
                                line : "Gráfico em Linhas",
                                saveAsImage: { show: true }
                            },
                        },
                        saveAsImage: {
                            title: 'Salvar Gráfico como Imagem'  
                        },
                        restore: { 
                            show: true,
                            title: 'Restaurar'
                        },
                    }
                },
                tooltip: {},
                dataset: {
                    dimensions: ['resultados', 'Em Execução', 'Perdidos/Parciais', 'Processados'],
                    source: dataSource
                },
                xAxis: { 
                    type: 'category' , 
                    name: 'Empresas',
                    nameLocation: 'middle',
                    nameTextStyle: {
                        fontSize: 15,
                        verticalAlign: "top",
                        lineHeight: 30,
                    }
                },
                yAxis: {
                    name: 'Quant. \nChecklists',
                    maxInterval: 10,
                    nameTextStyle: {
                        fontSize: 15,
                        align: 'left',
                    }
                },
                series: [{ type: 'bar' }, { type: 'bar' }, { type: 'bar' }]
            };
            chartBar.setOption(option);
        }
        
        function generateSelect2Units(){
            $('#units').select2( {
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $( this ).data( 'placeholder' ),
                closeOnSelect: false,
                tags: true,                
            });

            $('#units').val(unitsSelecteds).trigger("change");
        }

        function getSelectUnitsModal(){
            event.preventDefault();
            let select = '';
            let allUnits = <?= $units ?>; 
            let unitsSelecteds = ($("#units-selecteds-input").val()).split(',');

            let selectUnityForFilter = '<select multiple="multiple" name="unitsSelecteds[]" id="units-selecteds"> \n';
                allUnits.forEach(unity => {
                let selected = unitsSelecteds.includes(("000" + unity.id).slice(-3)) ? 'selected' : '';
                selectUnityForFilter +=`<option value="${unity.id}" ${selected}> ${unity.id} - ${unity.fantasy_name} </option>\n`;
            });
            selectUnityForFilter += '</select>';

            $("#select-unity-for-filter").empty();
            $("#select-unity-for-filter").append(selectUnityForFilter);
            initializeDualListBox('#select-unity-for-filter', 'Unidades Ativas', 'Unidades Selecionadas');
        }

        function confirmSelectUnits(){
            let unitsSelecteds = [];            
            $("#select-unity-for-filter").find("option:selected").each(function() {
                unitsSelecteds.push(("000" + $(this).val()).slice(-3));
            });
            $("#units-selecteds-input").val(unitsSelecteds);
        }

        $(document).ready(function() {
            generateSelect2Units();            
            if(Object.keys(reports.checklistByUnityAndStatus).length > 0) generateBarChart();

            $("#select-units").click(function(){ 
                getSelectUnitsModal();
            });

            $("#btn-confirm").click(function(){ 
                confirmSelectUnits();
            });
        });

    </script>
@endsection
