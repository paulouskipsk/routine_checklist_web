@extends('layouts.template')

@section('content')

    <div class="row border-bottom border-lightgray p-0 m-0 pb-2">

        <div class="col-3 m-0 px-0">
            <div class="input-group">
                <span class="input-group-text">Data Inicial</span>
                <input class="form-control datetimepicker" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' />
            </div>
        </div>

        <div class="col-3 m-0 px-1">
            <div class="input-group">
                <span class="input-group-text">Data Final</span>
                <input class="form-control datetimepicker" type="date" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' />
            </div>
        </div>


        <div class="col-5 m-0 px-1 ">
            <div class="input-group">
                <label class="input-group-text" >Unidades</label>
                <select class="form-select rounded-end w-100" data-choices="data-choices" multiple="multiple" data-options='{"removeItemButton":true}'>
                    <option>Todas as Unidades</option>
                    <option>001</option>
                    <option>002</option>
                    <option>003</option>
                    <option>004</option>
                </select>
            </div>
        </div>

        <div class="col-1 p-0 m-0">
            <button class="btn btn-primary mr-5" type="submit">Aplicar</button>
        </div>

    </div>

{{-- <div id="container-img-home">
    <img id="img-home" src="{{ asset('images/img_home2.png') }}"/>
</div> --}}

<div class="row text-center" style="margin-top: 5%">
    <div class="col-6 col-sm-12">
        <div class="chart-bar-home">
            <div class="mx-auto w-75" id="chart_bar" style="width: 80%;height:30em;"></div>
        </div>
    </div>
    <div class="col-6 col-sm-12">
        <div class="chart-pie-home">
            <div class="mx-auto" id="chart_pie" style="width: 100%;height:400px;"></div>
        </div>        
    </div>
</div>


<script type="text/javascript">
    // Initialize the echarts instance based on the prepared dom
    var chartBar = echarts.init(document.getElementById('chart_bar'));

    // Specify the configuration items and data for the chart
    var optionBar = {
      title: {
        text: 'Percentual de Execução dos checklists por unidade'
      },
      
      xAxis: {
        data: ['001', '002', '003', '004', '005', '006', '007', '008', '009', '010'],
        name: 'Unidades',
        nameLocation: 'middle',
        nameTextStyle: {
            padding: [20, 20, 20, 20]
        }
      },
      yAxis: { 
        name: 'Porcentagem das tarefas executadas',
        nameLocation: 'middle',
        nameTextStyle: {
            padding: [20, 20, 20, 20]
        }
      },
      series: [
        {
          name: 'sales',
          type: 'bar',
          data: [55, 80, 70, 80, 90, 95, 80, 70, 80, 90],
          showBackground: true,
            backgroundStyle: {
                color: 'rgba(180, 180, 180, 0.2)'
            }
        }
      ]
    };

    // Display the chart using the configuration items and data just specified.
    chartBar.setOption(optionBar);

    //---------------------------------------------------
    //PIE
    var chartPie = echarts.init(document.getElementById('chart_pie'));

    let optionPie = {
        title: {
            text: "Status dos checklists Geral",
            //subtext: 'Fake Data',
            left: 'center',
            padding: [0, 0, 50, 0]
        },
        tooltip: {
            trigger: 'item'
        },
        // legend: {
        //     orient: 'vertical',
        //     left: 'left'
        // },
        series: [
            {
            //name: 'Access From',
            type: 'pie',
            radius: '80%',
            data: [                
                { value: 30, name: "Perdidos - 30%" },
                { value: 65, name: "Executados - 65%" },
                { value: 5, name: "Execução - 5%" },
            ],
            emphasis: {
                itemStyle: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
            }
        ]
        };

    chartPie.setOption(optionPie);

  </script>



@endsection

