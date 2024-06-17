@extends('layouts.template')

@section('content')

    <form action="{{route('home')}}" method="GET" role="form">
        @csrf
        @method('GET')
        <div class="row">
            <div class="col-2 mx-0 px-1">
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

            <div class="col-2 mx-0 px-1">
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

            <div class="col-5 mx-0 px-1">
                <label class="form-label">Unidades</label>
                <select class="form-select" name="units[]" data-placeholder="Choose anything" multiple id="units">
                    @foreach ($units as $unity)
                        <option value="{{$unity->id}}" id="optionUnity{{$unity->id}}">
                            {{$unity->formatCode()}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-3 mt-4 mx-0 px-0">
                <button class="btn btn-primary px-1" id="select_all" type="button">Todos</button>
                <button class="btn btn-danger px-1" id="limpar" type="button">limpar</button>
                <button class="btn btn-success" type="submit">Aplicar</button>
            </div>

        </div>
    </form>

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
                {{$reports['finishedTotals']['percentages']['percentScoreRun']}}%
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
                {{$reports['finishedTotals']['percentages']['percentQuestionsExecuted']}}%
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
            {{$reports['finishedTotals']['percentages']['percentQuestionsLost']}}%
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
                {{$reports['finishedTotals']['percentages']['percentQuestionsNegatives']}}%
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
                {{$reports['finishedTotals']['percentages']['percentQuestionsAfirmatives']}}%
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
    </div>
@endsection

@section('postscript')
    <script type="text/javascript">
        let reports = <?= json_encode($reports) ?>;
        let units = <?= json_encode($units->pluck('id')) ?>;
        let unitsSelecteds = <?= json_encode($unitsSelecteds) ?>;
        let dataSource = [];

        function selectAll() {
            $("#units > option").prop("selected", true).trigger("change");
        }

        function deselectAll() {
            $("#units > option").prop("selected", false).trigger("change");
        }

        $("#limpar").on( "click", function(event) {
            event.preventDefault();
            deselectAll()
        });

        $("#select_all").on( "click", function() {
            selectAll()
        });

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

        $(document).ready(function() {
            generateSelect2Units()
            
            if(Object.keys(reports.checklistByUnityAndStatus).length > 0) generateBarChart();
        });

    </script>
@endsection
