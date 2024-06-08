@extends('layouts.template-report')

@section('content')
    <div id="report-checklistmov" class="card border border-300 my-1" data-component-card="data-component-card">
        <div class="card-header p-4 border-bottom border-300 bg-primary-subtle">
            <div class="row g-3">
                <div class="col-12 col-md">
                    <h4 class="text-900 mb-0" id="horizontal">
                        {{$checklistMov->id . ' - ' . $checklistMov->description }}
                    </h4>
                </div>
            </div>
        </div>
        <div class="card-body p-3">

            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header ">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            <h4 class="text-left text-primary p-1 text-uppercase"> Estatísticas e Pontuações</h4>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                        {{-- RESULTADO GERAL --}}
                        <div id="result-general" class="accordion-body">
                            <div class="mx-20">                
                                <div class="col-12 mb-3">
                                    <div class="card border border-300">
                                        <div class="card-body">
                                            <h4 class="card-title text-primary"> Geral </h4>
                                            <hr class="text-400">

                                            <div class="row border-bottom border-200 py-1">
                                                <div class="col-auto fs-0">
                                                    <span class="fw-bold mr-3">Unidade: </span> 
                                                    <span class="fst-italic mr-3">
                                                        {{$checklistMov->unity->formatCode() .' - '. $checklistMov->unity->corporate_name}}
                                                    </span>
                                                </div>
                                                <div class="col-auto fs-0">
                                                    <span class="fw-bold">CNPJ: </span> 
                                                    <span class="fst-italic">
                                                        {{$checklistMov->unity->cnpj}}
                                                    </span>
                                                </div>
                                                <div class="col-auto fs-0">
                                                    <span class="fw-bold">Cidade: </span> 
                                                    <span class="fst-italic">
                                                        {{$checklistMov->unity->address->city->name}}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="row border-bottom border-200 py-1">
                                                <div class="col-12 fs-0">
                                                    <span class="fw-bold mr-2">Último usuário vinculado à tarefa: </span> 
                                                    <span class="fst-italic">{{$checklistMov->user ? $checklistMov->user->id . ' - ' . $checklistMov->user->name : 'Não Associado'}}</span>
                                                </div>
                                            </div>

                                            <div class="row border-bottom border-200 py-1">
                                                <div class="col-auto fs-0">
                                                    <span class="fw-bold mr-2">Status Tarefa: </span> 
                                                    <span class="fst-italic text-{{$checklistMov->status == 'F' ? 'success' : 
                                                         ($checklistMov->status == 'S' ? 'danger' : 
                                                         ($checklistMov->status == 'C' ? 'warning' : 'info'))}}">

                                                        {{$checklistMov->status == 'F' ? 'Concluída' : 
                                                         ($checklistMov->status == 'S' ? 'Expirada' : 
                                                         ($checklistMov->status == 'C' ? 'Cancelada' : 'Em Andamento'))}}
                                                    </span>
                                                </div>

                                                <div class="col-auto fs-0">
                                                    <span class="fw-bold mr-2">Tarefa liberada: </span> 
                                                    <span class="fst-italic">{{Functions::formatDate($checklistMov->start_date, 'd/m/Y H:i')}}</span>
                                                </div>  
                                                <div class="col-auto fs-0">
                                                    <span class="fw-bold mr-2">Data Limite: </span> 
                                                    <span class="fst-italic">{{Functions::formatDate($checklistMov->end_date, 'd/m/Y H:i')}}</span>
                                                </div>  
                                                <div class="col-auto fs-0">
                                                    <span class="fw-bold mr-2">Data Processamento: </span> 
                                                    <span class="fst-italic">{{Functions::formatDate($checklistMov->processed_in, 'd/m/Y H:i') ?? 'Não Processada'}}</span>
                                                </div>
                                            </div>

                                            <div class="row border-bottom border-200 py-1">
                                                <div class="col-4 fs-0">
                                                    <span class="fw-bold mr-2">Total de Questões da Tarefa: </span> 
                                                    <span class="fst-italic">{{$report['totals']['questionsTotals']}}</span>
                                                </div>
                                                <div class="col-4 fs-0">
                                                    <span class="fw-bold mr-2">Total de Questões Não Respondidas: </span> 
                                                    <span class="fst-italic">{{$report['totals']['questionsLost']}}</span>
                                                </div>
                                                <div class="col-4 fs-0">
                                                    <span class="fw-bold mr-2">Total de Questões Respondidas: </span> 
                                                    <span class="fst-italic">{{$report['totals']['questionsExecuted']}}</span>
                                                </div>  
                                            </div>

                                            <div class="row border-bottom border-200 py-1">
                                                <div class="col-4 fs-0">
                                                    <span class="fw-bold mr-2">Pontuação Geral da Tarefa: </span> 
                                                    <span class="fst-italic">{{$report['totals']['scoreTotal']}}</span>
                                                </div>
                                                <div class="col-4 fs-0">
                                                    <span class="fw-bold mr-2">Pontuação Executada: </span> 
                                                    <span class="fst-italic">{{$report['totals']['scoreRun']}}</span>
                                                </div>
                                                <div class="col-4 fs-0">
                                                    <span class="fw-bold mr-2">Percentual Atingido: </span> 
                                                    <span class="fst-italic">{{$report['percentages']['percentScoreRun']}} %</span>
                                                </div>  
                                            </div>

                                            <div class="row border-bottom border-200 py-1">
                                                <div class="col-4 fs-0 bg-soft">
                                                    <span class="fw-bold mr-2 text-primary">Contadores por tipos de resposta: </span> 
                                                </div>    
                                                <div class="col-4 fs-0 bg-soft">
                                                    <span class="fw-bold mr-2 text-primary">Resposta </span> 
                                                </div>
                                                <div class="col-4 fs-0 bg-soft">
                                                    <span class="fw-bold mr-2 text-primary">Porcentagem </span>
                                                </div>                                                                                  
                                            </div>

                                            <div class="row py-1">
                                                <div class="col-4"></div>

                                                <div class="col-4 fs-0">                                                    
                                                    <p class="my-1">
                                                        <span class="fw-bold">Sim:</span>
                                                        <span class="fst-italic">{{$report['totals']['questionsY']}}</span>
                                                    <p class="my-1">
                                                        <span class="fw-bold">Não:</span>
                                                        <span class="fst-italic">{{$report['totals']['questionsN']}}</span>
                                                    <p class="my-1">
                                                        <span class="fw-bold">Ruim:</span>
                                                        <span class="fst-italic">{{$report['totals']['questionsB']}}</span>
                                                    <p class="my-1">
                                                        <span class="fw-bold">Bom:</span>
                                                        <span class="fst-italic">{{$report['totals']['questionsG']}}</span>
                                                    <p class="my-1">
                                                        <span class="fw-bold">Excelente:</span>
                                                        <span class="fst-italic">{{$report['totals']['questionsE']}}</span>
                                                </div>
                                                <div class="col-auto fs-0">
                                                    <p class="my-1">
                                                        <span class="fw-bold">Sim:</span>
                                                        <span class="fst-italic">{{$report['percentages']['percentQuestionsY']}}%</span>
                                                    <p class="my-1">
                                                        <span class="fw-bold">Não:</span>
                                                        <span class="fst-italic">{{$report['percentages']['percentQuestionsN']}}%</span>
                                                    <p class="my-1">
                                                        <span class="fw-bold">Ruim:</span>
                                                        <span class="fst-italic">{{$report['percentages']['percentQuestionsB']}}%</span>
                                                    <p class="my-1">
                                                        <span class="fw-bold">Bom:</span>
                                                        <span class="fst-italic">{{$report['percentages']['percentQuestionsG']}}%</span>
                                                    <p class="my-1">
                                                        <span class="fw-bold">Excelente:</span>
                                                        <span class="fst-italic">{{$report['percentages']['percentQuestionsE']}}%</span>
                                                </div>                                                                                         
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- RESULTADO POR SETOR --}}
                        <div id="result-sector" class="accordion-body">
                            <div class="mx-20">                
                                <div class="col-12 mb-3">
                                    <div class="card border border-300">
                                        <div class="card-body">
                                            <h4 class="card-title text-primary"> Por Área </h4>
                                            <hr class="text-400">

                                            <table class="table">
                                                <thead>
                                                    <tr class="py-0">
                                                        <th>Cod.<br/> Setor</th>
                                                        <th>Descrição do Setor</th>
                                                        <th>Tot. <br/> Questões</th>
                                                        <th>Tot. Quest.<br/>Afirmativa(s)</th>
                                                        <th>% Resp.<br/>Afirmativa(s)</th>
                                                        <th>Tot. Quest.<br/>Negativa(s)</th>
                                                        <th>% Resp.<br/>Negativa(s)</th>
                                                        <th>Tot. Pontos <br/> Gerado</th>
                                                        <th>Tot. Pontos <br/> Executado</th>
                                                        <th>% Pontos<br/>Executado</th>
                                                    </tr>
                                                </thead>
                            
                                                <tbody>
                                                    @foreach ( $report['totalsSectors'] as $sectorId => $totalSector)
                                                    <tr>
                                                        <td class="py-1"> {{$sectorId}} </td>
                                                        <td class="py-1"> {{$report['sectors'][$sectorId]->description}}</td>
                                                        <td class="py-1"> {{$totalSector['questionsTotals']}} </td>
                                                        <td class="py-1"> {{$totalSector['questionsAfirmatives']}} </td>
                                                        <td class="py-1">{{$report['percentagesSectors'][$sectorId]['percentQuestionsAfirmatives']}}%</td>
                                                        <td class="py-1"> {{$totalSector['questionsNegatives']}} </td>
                                                        <td class="py-1">{{$report['percentagesSectors'][$sectorId]['percentQuestionsNegatives']}}%</td>
                                                        <td class="py-1">{{$totalSector['scoreTotal']}}</td>
                                                        <td class="py-1">{{$totalSector['scoreRun']}}</td>
                                                        <td class="py-1">{{$report['percentagesSectors'][$sectorId] ['percentScoreRun']}}%</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr class="fw-bold">
                                                        <td colspan="2"> TOTAIS </td>
                                                        <td> {{$report['totals']['questionsTotals']}} </td>
                                                        <td> {{$report['totals']['questionsAfirmatives']}} </td>
                                                        <td> {{$report['percentages']['percentQuestionsAfirmatives']}}% </td>
                                                        <td> {{$report['totals']['questionsNegatives']}} </td>
                                                        <td> {{$report['percentages']['percentQuestionsNegatives']}}% </td>
                                                        <td> {{$report['totals']['scoreTotal']}} </td>
                                                        <td> {{$report['totals']['scoreRun']}} </td>
                                                        <td> {{$report['percentages']['percentScoreRun']}}% </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PERGUNTAS E RESPOSTAS --}}
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed"
                                type="button" 
                                data-bs-toggle="collapse"
                                data-bs-target="#questions" 
                                aria-expanded="true"
                                aria-controls="questions">
                            <h4 class="text-left text-primary p-1 text-uppercase"> Perguntas e Respostas</h4>                            
                        </button>
                    </h2>

                    @foreach ($checklistMov->checklistItensMovs as $checklistItemMov)                        
                    <div id="questions" class="accordion-collapse collapse show">
                        <div class="accordion-body">                            
                            <div class="card border border-300 border-rounded-0">
                                <div class="card-body p-0">
                                                                       
                                    <div class="accordion">
                                        <div class="accordion-item border-0 p-0 rounded-top">
                                            <h2 class="accordion-header mb-0 alert py-0 alert-soft-primary rounded-bottom-0">
                                                <button class="accordion-button" 
                                                        type="button" 
                                                        data-bs-toggle="collapse" 
                                                        data-bs-target="#target-{{$checklistItemMov->id}}" 
                                                        aria-expanded="true" 
                                                        aria-controls="target-{{$checklistItemMov->id}}">
                                                    <span class="text-info">{{$checklistItemMov->sequence .' - '.  $checklistItemMov->description }}</span>
                                                </button>
                                            </h2>

                                            <div class="accordion-collapse collapse show border-top border-300" id="target-{{$checklistItemMov->id}}">
                                                <div class="accordion-body p-3">

                                                    <div class="row border-bottom border-200 py-1">
                                                        <div class="col-6 fs-0">
                                                            <span class="fw-bold">Processada: </span> 
                                                            <span class="fst-italic">{{$checklistItemMov->processed == 'S' ? 'Sim' : 'Não'}}</span>
                                                        </div>
                                                        
                                                        <div class="col-6 fs-0">
                                                            <span class="fw-bold">Setor: </span>
                                                            <span class="fst-italic">{{$checklistItemMov->sector?->description ?? 'Não Informado'}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom border-200 py-1">
                                                        <div class="col-6 fs-0">
                                                            <span class="fw-bold">Pontos da pergunta: </span>
                                                            <span class="fst-italic">{{$checklistItemMov->score}}</span>
                                                        </div>

                                                        <div class="col-6 fs-0">
                                                            <span class="fw-bold">Pontuação Executada: </span> 
                                                            <span class="fst-italic">
                                                                {{Functions::getScoreExecution($checklistItemMov)}}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom border-200 py-1">
                                                        <div class="col-6 fs-0">
                                                            <span class="fw-bold">Usuário: </span> 
                                                            <span class="fst-italic">{{$checklistItemMov->user ? ($checklistItemMov->user->id .' - '.$checklistItemMov->user->name) : 'Não Vinculado'}}</span>
                                                        </div>
                                                        <div class="col-6 fs-0">
                                                            <span class="fw-bold">Data/Hora Resposta: </span>
                                                            <span class="fst-italic">{{$checklistItemMov->processed_in ? $checklistItemMov->processed_in->format('d/m/Y H:i') : 'Não Informado'}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom border-200 py-1">
                                                        <div class="col-6 fs-0">
                                                            <span class="fw-bold">Tipo Pergunta: </span> 
                                                            <span class="fst-italic">{{$checklistItemMov->type == 'S' ? 'Sim/Não' : 'Avaliativa'}}</span>
                                                        </div>

                                                        <div class="col-6 fs-0">
                                                            <span class="fw-bold">Resposta:</span>
                                                            <span class="fst-italic">{{Functions::getResponseText($checklistItemMov->response)}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom border-200 py-1">
                                                        <div class="col-12 fs-0">
                                                            <span class="fw-bold">Observações: </span> 
                                                            <span class="fst-italic">{{$checklistItemMov->observation ?? 'Não Informado'}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="row border-bottom border-0 py-1">
                                                        <div class="col-12 fs-0">
                                                            <span class="fw-bold">Fotos: </span> 
                                                            @if ($checklistItemMov->photos)
                                                            <div class="text-left m-1 pt-1">                                                           
                                                                @foreach ($checklistItemMov->photos as $index => $photo)                                                            
                                                                <div class="w-200 float-start px-1 pb-2">
                                                                    <img 
                                                                    src="data:image/jpeg;base64,{{$photo}}" 
                                                                    class="img-thumbnail rounded border border-300 w-100 pt-1 checklistItemMovPhoto cursor-pointer" 
                                                                    data-bs-toggle="modal" 
                                                                    data-bs-target="#photoShowModal"
                                                                    data-bs-title="{{$checklistItemMov->description . ' ( Foto '.  str_pad($index+1, 2 , '0' , STR_PAD_LEFT) .' )'}}">
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            @else
                                                            <span class="fst-italic">Não Informado</span>
                                                            @endif
                                                        </div>
                                                    </div>                                                    
                                                </div>                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="photoShowModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content ">
        <div class="modal-header alert alert-soft-primary text-primary py-3 px-5 border border-bottom-400">
          <h1 class="modal-title fs-1 text-primary fw-bold" id="staticBackdropLabel">
            <span id="photoModalTitle"></span>
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">

            <div class="row content-justify-center">
                <div class="col-12 text-center">
                    <div id="photoModalDiv">
                        <img id="imgModal">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('postscript')
    <script type="text/javascript">

        $(document).ready(function() {
            (document.getElementById('btn-back')).addEventListener('click', () => { history.back(); });
            (document.getElementById('btn-pdf')).addEventListener('click', () => { 
                // window.open("{{route('report_task', $checklistMov->id)}}", '_self');
                window.open("{{route('report_task', $checklistMov->id)}}");
            });

            const photoShowModal = document.getElementById('photoShowModal');
            photoShowModal.addEventListener('show.bs.modal', event => {
                const img = event.relatedTarget;
                const image = img.getAttribute('src');
                $("#imgModal").attr("src", image);
                $("#photoModalTitle").text(img.getAttribute('data-bs-title'));
            });

        });
    </script>
@endsection
