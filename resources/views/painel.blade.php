@extends('master')
@section('title', 'Painel')

@section('content')

<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">


      <!-- PAINEL PRINCIPAL -->
      <div class="col-md-8">
        <div class="quadro-painel painel-propostas">
          <div class="panel panel-default">
            <!-- CABEÇALHO PAINEL -->
            <div class="panel-heading">
              <span class="panel-title"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;&nbsp;Suas Propostas</span>
            </div>
            <div class="panel-body">
              <!-- LISTA DE PROPOSTAS -->

              @if($propostas->isEmpty())
              <p>Não há propostas.</p>
              @else
              
              @foreach($propostas as $proposta)
              <div class="painel-lista">
                <!-- List group -->
                <ul class="list-group">
                  <li class="list-group-item titulo-lista">
                    <span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;Proposta 1
                    <div class="pull-right">
                      <a href="{!! action('PropostasController@show', $proposta->cod_obra) !!}">Mais Informações</a>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <p><small>Submetida em {!! $proposta->data_envio !!}</small></p>
                    <p><strong>Título da Obra: </strong>{!! $proposta->titulo !!}</p>
                    <p><strong>Subtítulo da Obra: </strong>{!! $proposta->subtitulo !!}</p>
                    <p><strong>Descrição: </strong>{!! $proposta->descricao !!}</p>
                  </li>
                </ul>
              </div> <!-- painel-lista -->
              @endforeach

              <!-- FIM LISTA DE PROPOSTAS -->
            </div> <!-- panel-body -->
            @endif
            <!-- RODAPÉ PAINEL -->
            <div class="panel-footer">
              <a class="btn btn-success" href="/enviar-proposta" role="button"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;Submeter Nova Proposta</a>
            </div>
          </div> <!-- panel -->
        </div> <!-- quadro-painel painel-propostas -->
      </div> <!-- col -->


      <!-- PAINEL DE NOTIFICAÇÕES -->
      <div class="col-md-4">
        <div class="quadro-painel painel-notificacoes">
          <div class="panel panel-default">
            <!-- CABEÇALHO PAINEL -->
            <div class="panel-heading">
              <span class="panel-title"><span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;&nbsp;Notificações</span>
            </div>
            <!-- CORPO PAINEL -->
            <div class="panel-body">
              <div class="alert alert-info" role="alert">
                <strong>Proposta Submetida!</strong> <small>05/06/2017</small>
                <br/>Sua proposta foi submetida para avaliação.
              </div>
              <div class="alert alert-success" role="alert">
                <strong>Proposta Aprovada!</strong> <small>05/06/2017</small>
                <br/>Sua proposta foi aprovada e será enviada para revisão.
              </div>
              <div class="alert alert-danger" role="alert">
                <strong>Proposta Recusada!</strong> <small>05/06/2017</small>
                <br/>Sua proposta foi recusada.
              </div>
              <div class="alert alert-info" role="alert">
                <strong>Proposta Submetida!</strong> <small>05/06/2017</small>
                <br/>Sua proposta foi submetida para avaliação.
              </div>
              <div class="alert alert-success" role="alert">
                <strong>Proposta Aprovada!</strong> <small>05/06/2017</small>
                <br/>Sua proposta foi aprovada e será enviada para revisão.
              </div>
              <div class="alert alert-danger" role="alert">
                <strong>Proposta Recusada!</strong> <small>05/06/2017</small>
                <br/>Sua proposta foi recusada.
              </div>
            </div> <!-- panel-body -->
          </div> <!-- panel -->
        </div> <!-- quadro-painel painel-notificacoes -->
      </div> <!-- col -->

    </div> <!-- row -->
  </div> <!--container -->
</div> <!-- content -->

@endsection
