@extends('reports-pdf.layouts.portrait')

@section('content')

<p class="alert alert-primary px-1 py-1 bold mt-5 fs-15">Estatísticas e Pontuações</p>


<div class="bold fs-13 mb-0 text-primary">GERAL</div>
<hr class="mt-0"/>
<table>
    <tbody>
      <tr><td>
          <span class="bold fs-12">Tarefa: </span>
          <span class="mr-1 italic fs-12">{{"$checklistMov->id - $checklistMov->description"}}</span>
      </td></tr>

      <tr><td>
          <span class="bold fs-12">Unidade: </span>
          <span class="mr-3 italic fs-12"> {{Functions::formatPadLeft($unity->id, 3) ." - $unity->corporate_name"}}</span>
          <span class="bold fs-12"> CNPJ: </span>
          <span class="mr-3 italic fs-12"> {{$unity->cnpj}}</span>
          <span class="bold fs-12"> Cidade: </span>
          <span class="mr-1 italic fs-12"> {{$unity->address->city->name}}</span>
        </td></tr>

        <tr><td>
          <span class="bold fs-12">Último usuário vinculado à tarefa: </span>
          <span class="mr-5 italic fs-12">{{$checklistMov->user ? $checklistMov->user->id .' - '. $checklistMov->user->name : ''}}</span>
      
          <span class="bold fs-12">Status Tarefa: </span>
          <span class="italic fs-12 text-{{$checklistMov->status == 'A' ? 'primary' : 
            ($checklistMov->status == 'F' ? 'success' : 
            ($checklistMov->status == 'S' ? 'danger' : 'warning'))
            }}">
            {{$checklistMov->status == 'A' ? 'Em Execução' : 
            ($checklistMov->status == 'F' ? 'Concluída' : 
            ($checklistMov->status == 'S' ? 'Expirado' : 'Cancelado'))
            }}
        </span>
        </td></tr>

        <tr><td>
          <span class="bold fs-12">DT Início: </span>
          <span class="mr-3 italic fs-12">{{Functions::FormatDate($checklistMov->start_date, 'd/m/Y H:i')}}</span>

          <span class="bold fs-12">DT Limite: </span>
          <span class="mr-3 italic fs-12">{{Functions::FormatDate($checklistMov->end_date, 'd/m/Y H:i')}}</span>

          <span class="bold fs-12">Processada em: </span>
          <span class="mr-3 italic fs-12">{{Functions::FormatDate($checklistMov->processed_in, 'd/m/Y H:i')}}</span>
        </td></tr>

        <tr><td>
          <span class="bold fs-12">Tot Questões da Tarefa: </span>
          <span class="mr-1 italic fs-12">{{$report['totals']['questionsTotals']}}</span>

          <span class="bold fs-12">Tot. Não Respondidas: </span>
          <span class="mr-1 italic fs-12">{{$report['totals']['questionsLost']}}</span>

          <span class="bold fs-12">Tot. Respondidas: </span>
          <span class="mr-1 italic fs-12">{{$report['totals']['questionsExecuted']}}</span>
      </td></tr>

      <tr><td>
        <span class="bold fs-12">Pontuação geral da Tarefa: </span>
        <span class="mr-1 italic fs-12">{{$report['totals']['scoreTotal']}}</span>

        <span class="bold fs-12">Pontuação Executada: </span>
        <span class="mr-1 italic fs-12">{{$report['totals']['scoreRun']}}</span>

        <span class="bold fs-12">Percentual Atingido: </span>
        <span class="mr-1 italic fs-12">{{$report['percentages']['percentScoreRun'].'%'}}</span>
      </td></tr>

      <tr> 
        <td>

          <table>
            <thead">
              <tr>
                <th class="bold fs-12 text-primary text-left w-15 ">
                  Contadores por tipos de resposta 
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </th>
                <th class="bold fs-12 text-primary text-left">Resposta</th>
                <th class="bold fs-12 text-primary text-left">Porcentagem</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td>
                  <span class="bold fs-12">Sim:</span>
                  <span class="mr-1 italic fs-12">{{$report['totals']['questionsY']}}</span>
                  <br/>
                  <span class="bold fs-12">Não:</span>
                  <span class="mr-1 italic fs-12">{{$report['totals']['questionsN']}}</span>
                  <br/>
                  <span class="bold fs-12">Ruim:</span>
                  <span class="mr-1 italic fs-12">{{$report['totals']['questionsB']}}</span>
                  <br/>
                  <span class="bold fs-12">Bom:</span>
                  <span class="mr-1 italic fs-12">{{$report['totals']['questionsG']}}</span>
                  <br/>
                  <span class="bold fs-12">Excelente:</span>
                  <span class="mr-1 italic fs-12">{{$report['totals']['questionsE']}}</span>
            </div>

                </td>
                <td>
                  <span class="bold fs-12">Sim: </span>
                  <span class="mr-1 italic fs-12">{{$report['percentages']['percentQuestionsY']}}'%'</span>
                  <br/>

                  <span class="bold fs-12">Não: </span>
                  <span class="mr-1 italic fs-12">{{$report['percentages']['percentQuestionsN']}}'%'</span>
                  <br/>

                  <span class="bold fs-12">Ruim: </span>
                  <span class="mr-1 italic fs-12">{{$report['percentages']['percentQuestionsB']}}'%'</span>
                  <br/>

                  <span class="bold fs-12">Bom: </span>
                  <span class="mr-1 italic fs-12">{{$report['percentages']['percentQuestionsG']}}'%'</span>
                  <br/>

                  <span class="bold fs-12">Excelente: </span>
                  <span class="mr-1 italic fs-12">{{$report['percentages']['percentQuestionsE']}}'%'</span>
                  <br/>
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>


    <div class="bold fs-13 mt-3 text-primary">POR ÁREA</div>
    {{-- RESULTADO POR SETOR --}}
    <table class="table table-striped table-condensed">
        <thead>
            <tr class="py-0 fs-10 text-dark bold">
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

        <tbody class="fs-10">
            @foreach ( $report['totalsSectors'] as $sectorId => $totalSector)
            <tr>
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
            <tr class="bold fs-10">
                <td> TOTAIS </td>
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

    <div style="page-break-after: always"></div>

    {{-- PERGUNTAS --}}
    <p class="alert alert-primary px-1 py-1 bold fs-15">Perguntas X Respostas</p>

    @foreach ($checklistMov->checklistItensMovs as $checklistItemMov)                        

    <div class="border-1 mt-2">
        <table class="table table-condensed">
            <tbody class="fs-10">
                <tr colspan="2" class="alert alert-secondary bold text-uppercase">
                    <td class="py-0">
                        <span class="mr-1 italic">{{$checklistItemMov->id .' - '.$checklistItemMov->description}}</span>
                    </td>
                    <td class="py-0"></td>
                </tr>
                <tr>
                    <td class="py-0">
                        <span class="bold">Processada:</span>
                        <span class="mr-1 italic">{{$checklistItemMov->processed == 'S' ? 'Sim' : 'Não'}}</span>
                    </td>
                    <td class="py-0">
                        <span class="bold">Setor:</span>
                        <span class="mr-1 italic">{{$checklistItemMov->sector?->description ?? 'Não Informado'}}</span>
                    </td>
                </tr>
                <tr>
                    <td class="py-0">
                        <span class="bold">Pontos da pergunta:</span>
                        <span class="mr-1 italic">{{$checklistItemMov->score}}</span>
                    </td>
                    <td class="py-0">
                        <span class="bold">Pontuação Executada:</span>
                        <span class="mr-1 italic">{{Functions::getScoreExecution($checklistItemMov)}}</span>
                    </td>
                </tr>
                <tr>
                    <td class="py-0">
                        <span class="bold">Usuário:</span>
                        <span class="mr-1 italic">
                            {{$checklistItemMov->user ? ($checklistItemMov->user->id .' - '.$checklistItemMov->user->name) : 'Não Vinculado'}}
                        </span>
                    </td>
                    <td class="py-0">
                        <span class="bold">Data/Hora Resposta:</span>
                        <span class="mr-1 italic">{{$checklistItemMov->processed_in ? $checklistItemMov->processed_in->format('d/m/Y H:i') : 'Não Informado'}}</span>
                    </td>
                </tr>
                <tr>
                    <td class="py-0">
                        <span class="bold">Tipo Pergunta:</span>
                        <span class="mr-1 italic">{{$checklistItemMov->type == 'S' ? 'Sim/Não' : 'Avaliativa'}}</span>
                    </td>
                    <td class="py-0">
                        <span class="bold">Resposta:</span>
                        <span class="mr-1 italic">{{Functions::getResponseText($checklistItemMov->response)}}</span>
                    </td>
                </tr>

                <tr colspan="2">
                    <td class="py-0">
                        <span class="bold">Observações:</span>
                        <span class="mr-1 italic">{{$checklistItemMov->observation ?? 'Não Informado'}}</span>
                    </td>
                    <td class="py-0"></td>
                </tr>
                <tr colspan="2">
                    <td class="py-0">
                        <span class="bold">Fotos:</span>

                        @if ($checklistItemMov->photos)
                        <div class="text-left m-1 pt-1">                                                           
                        @foreach ($checklistItemMov->photos as $index => $photo)                                                            
                            <img src="data:image/jpeg;base64,{{$photo}}" class="img-thumbnail pt-1 img-200">
                        @endforeach
                        </div>
                        @else
                        <span class="mr-1 italic">Não Informado</span>
                        @endif
                    </td>
                    <td class="py-0"></td>
                </tr>
            </tbody>
        </table>
    </div>
    @endforeach
@endsection