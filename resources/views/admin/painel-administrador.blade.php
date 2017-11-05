@extends('master')
@section('title', 'Área do administrador')

@section('content')

<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">

      @foreach ($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
      @endforeach

      <!-- PAINEL PRINCIPAL -->
      <div class="col-md-8 col-md-offset-2">
        <div class="quadro-painel painel-propostas">
          <div class="panel panel-default">
            <!-- CABEÇALHO PAINEL -->
            <div class="panel-heading">
              <span class="panel-title"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;&nbsp;Suas Propostas</span>
            </div>
            <div class="panel-body">
              <!-- LISTA DE PROPOSTAS -->

              @if($propostas->isEmpty())
              <div class="alert alert-info" role="alert">
                <p>Ninguém enviou uma proposta ainda. :( </p>
              </div>
              @else

              @foreach($propostas as $proposta)
              <div class="painel-lista">
                <!-- List group -->
                <ul class="list-group">
                  <li class="list-group-item titulo-lista">
                    <span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;Proposta 1
                    <div class="pull-right">
                      <a href="{!! action('AdminController@show', $proposta->cod_proposta) !!}">Mais Informações</a>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <p><small>Submetida em {!! $proposta->data_envio !!}</small></p>
                    <p><strong>Título da Obra: </strong>{!! $proposta->titulo !!}</p>
                    <p><strong>Subtítulo da Obra: </strong>{!! $proposta->subtitulo !!}</p>
                    <p><strong>Descrição: </strong>{!! $proposta->descricao !!}</p>
                    <p class="alert alert-warning"><strong>Situação: </strong>{!! $proposta->situacao !!}</p>
                  </li>
                </ul>
              </div> <!-- painel-lista -->
              @endforeach

              <!-- FIM LISTA DE PROPOSTAS -->
              @endif
            </div> <!-- panel-body -->
            <!-- RODAPÉ PAINEL -->
            <div class="panel-footer">
              <a class="btn btn-success" href="/enviar-proposta" role="button"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;Submeter Nova Proposta</a>
            </div>
          </div> <!-- panel -->
        </div> <!-- quadro-painel painel-propostas -->
      </div> <!-- col -->

    </div> <!-- row -->
  </div> <!--container -->
</div> <!-- content -->

@endsection
