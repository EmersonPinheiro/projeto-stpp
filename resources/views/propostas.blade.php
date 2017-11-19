@extends('master')
@section('title', 'Propostas')

@section('content')
@role('propositor')
<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">

      <!-- PAINEL PRINCIPAL -->
      <div class="col-md-8">
        <div class="painel-propostas">
          <div class="panel panel-default">
            <!-- CABEÇALHO PAINEL -->
            <div class="panel-heading">
              <span class="panel-title"><span class="glyphicon glyphicon-th-list glyphicon-space"></span><strong>Suas Propostas</strong></span>
            </div>

            <!-- CORPO PAINEL -->
            <div class="panel-body">
              <!-- LISTA DE PROPOSTAS -->
              @if($propostas->isEmpty())
                <div class="alert alert-info" role="alert">
                  <p>Você ainda não cadastrou propostas! Clique no botão abaixo para submeter uma nova proposta.</p>
                </div>
              @else
                @foreach($propostas as $proposta)
                  <div class="painel-lista">
                    <!-- List group -->
                    <ul class="list-group">
                      <li class="list-group-item titulo-lista">
                        <div class="pull-right">
                          <a href="{!! action('PropostasController@show', $proposta->cod_proposta) !!}">Mais Informações</a>
                        </div>
                        <span class="glyphicon glyphicon-book glyphicon-space"></span>{!! $proposta->titulo !!}
                      </li>
                      <li class="list-group-item">
                        <p class="alert alert-warning pull-right"><strong>Situação: </strong>{!! $proposta->situacao !!}</p>
                        <p><strong>Título da Obra: </strong>{!! $proposta->titulo !!}</p>
                        <p><strong>Subtítulo da Obra: </strong>{!! $proposta->subtitulo !!}</p>
                        <p><strong>Resumo: </strong>{!! $proposta->resumo !!}</p>
                        <p><small>Submetida em {!! $proposta->data_envio !!}</small></p>
                      </li>
                    </ul>
                  </div> <!-- painel-lista -->
                @endforeach
                <!-- FIM LISTA DE PROPOSTAS -->
              @endif
            </div> <!-- panel-body -->

            <!-- RODAPÉ PAINEL -->
            <div class="panel-footer">
              <a class="btn btn-success" href="/enviar-proposta" role="button"><span class="glyphicon glyphicon-plus glyphicon-space"></span>Submeter Nova Proposta</a>
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
              <span class="panel-title"><span class="glyphicon glyphicon-bell glyphicon-space"></span><strong>Notificações</strong></span>
            </div>
            <!-- CORPO PAINEL -->
            <div class="panel-body">
              @if(Auth::user()->notifications->isEmpty())
                <div class="alert alert-info">
                  <span class="glyphicon glyphicon-pushpin glyphicon-space"></span>
                  Não há notificações.
                </div>
              @else
                @foreach(Auth::user()->notifications as $notification)
                  <div class="alert alert-info" role="alert">
                    <p><span class="glyphicon glyphicon-pushpin glyphicon-space"></span>
                    {{$notification->data['message_user']}}</p>
                    <p><small>{{$notification->created_at}}</small></p>
                  </div>
                @endforeach
              @endif
            </div> <!-- panel-body -->
          </div> <!-- panel -->
        </div> <!-- quadro-painel painel-notificacoes -->
      </div> <!-- col -->

    </div> <!-- row -->
  </div> <!--container -->
</div> <!-- content -->
@endrole
@endsection
