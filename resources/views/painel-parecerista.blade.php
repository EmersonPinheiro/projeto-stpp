@extends('master')
@section('title', 'Pareceres')

@section('content')

@role('parecerista')
<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">

      <div class="col-md-8">
        @foreach ($errors->all() as $error)
        <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
      </div>

      <!--TODO: Implementar função para parecerista se tornar propositor-->

      <!-- PAINEL PRINCIPAL -->
      <div class="col-md-8">
        <div class="painel-propostas">
          <div class="panel panel-default">

            <!-- CABEÇALHO PAINEL -->
            <div class="panel-heading">
              <span class="panel-title"><span class="glyphicon glyphicon-th-list glyphicon-space"></span><strong>Lista de Propostas para Avaliação</strong></span>
            </div>

            <!-- CORPO PAINEL -->
            <div class="panel-body">

              <!-- LISTA DE PROPOSTAS -->
              @if($obrasPareceres->isEmpty())
                <div class="alert alert-info" role="alert">
                  <p>Não há propostas a serem avaliadas.</p>
                </div>
              @else
                @foreach($obrasPareceres->reverse() as $obra)
                  <div class="painel-lista">
                    <!-- List group -->
                    <ul class="list-group">
                      <li class="list-group-item titulo-lista">
                        <div class="pull-right">
                          @if($obra->prazo_restante > 0)
                          <a href="{!! action('ParecerController@create', $obra->cod_parecer) !!}">Enviar Parecer</a>
                            @if(!$obra->envio)
                              <span class="text-danger">(Restam {!! $obra->prazo_restante !!} dias!)</span>
                            @else
                              <span class="text-success">(Parecer enviado!)</span>
                            @endif
                          </strong>
                          @else
                            <span class="text-danger">Seu prazo acabou!</span> <a href="{!! action('ParecerController@solicitarPrazo', $obra->cod_parecer) !!}">Clique para solicitar prorrogação do prazo.</a>
                          @endif
                        </div>
                        <span class="glyphicon glyphicon-book glyphicon-space"></span>{!! $obra->titulo !!}
                      </li>
                      <li class="list-group-item">
                        <p><strong>Título da Obra: </strong>{!! $obra->titulo !!}</p>
                        <p><strong>Subtítulo da Obra: </strong>{!! $obra->subtitulo !!}</p>
                        <p><strong>Resumo: </strong>{!! $obra->resumo !!}</p>
                      </li>
                    </ul>
                  </div> <!-- painel-lista -->
                @endforeach
              @endif
              <!-- FIM LISTA DE PROPOSTAS -->
            </div> <!-- panel-body -->
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
