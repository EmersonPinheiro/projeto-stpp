@extends('master')
@section('title', 'Área do administrador')

@section('content')

<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">

      <div class="col-md-8 col-md-offset-2">
        @foreach ($errors->all() as $error)
        <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
      </div>

      <!-- PAINEL PRINCIPAL -->
      <div class="col-md-8 col-md-offset-2">
        <div class="painel-propostas">
          <div class="panel panel-default">
            <!-- CABEÇALHO PAINEL -->
            <div class="panel-heading">
              <span class="panel-title"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;&nbsp;Propostas</span>
            </div>
            <div class="panel-body">
              <!-- LISTA DE PROPOSTAS -->

              @if($propostas->isEmpty())
              <div class="alert alert-info" role="alert">
                <p>Não há propostas cadastradas no momento!</p>
              </div>
              @else

              @foreach($propostas as $proposta)
              <div class="painel-lista">
                <!-- List group -->
                <ul class="list-group">
                  <li class="list-group-item titulo-lista">
                    <div class="pull-right">
                      <a href="{!! action('AdminController@show', $proposta->cod_proposta) !!}">Mais Informações</a>
                    </div>
                    <span class="glyphicon glyphicon-book glyphicon-space"></span>{!! $proposta->titulo !!}
                  </li>
                  <li class="list-group-item">
                    <p class="alert alert-warning pull-right"><strong>Situação: </strong>{!! $proposta->situacao !!}</p>
                    <p><strong>Título da Obra: </strong>{!! $proposta->titulo !!}</p>
                    <p><strong>Subtítulo da Obra: </strong>{!! $proposta->subtitulo !!}</p>
                    <p><strong>Descrição: </strong>{!! $proposta->descricao !!}</p>
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
              <span class="panel-title"><span class="glyphicon glyphicon-bell"></span>&nbsp;&nbsp;&nbsp;Notificações</span>
            </div>
            <!-- CORPO PAINEL -->
            <div class="panel-body">
              @foreach($admin->notifications as $notification)
              <div class="alert alert-info" role="alert">
                    {{$notification->data['message']}}
              </div>
              @endforeach

              </div>
            </div> <!-- panel-body -->
          </div> <!-- panel -->
        </div> <!-- quadro-painel painel-notificacoes -->
      </div> <!-- col -->

    </div> <!-- row -->
  </div> <!--container -->
</div> <!-- content -->

@endsection
