@extends('master')
@section('title', 'Propostas')

@section('content')
@role('propositor')
<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">


      <!-- PAINEL PRINCIPAL -->
      <div class="col-md-8 col-md-offset-2">
        <div class="painel-propostas">
          <div class="panel panel-default">
            <!-- CABEÇALHO PAINEL -->
            <div class="panel-heading">
              <span class="panel-title"><span class="glyphicon glyphicon-th-list glyphicon-space"></span>Suas Propostas</span>
            </div>
            <div class="panel-body">
              <!-- LISTA DE PROPOSTAS -->

              @if(!$propostas->isEmpty())
              <div class="alert alert-info" role="alert">
                <p>Você ainda não cadastrou propostas! Clique no botão abaixo para submeter uma nova proposta.</p>
              </div>
              @else

              <div class="painel-lista">
                <!-- List group -->
                <div class="list-group">
                  <div class="list-group-item titulo-lista">
                    <span class="glyphicon glyphicon-book glyphicon-space"></span>Proposta
                    <div class="pull-right">
                      <a href="#">Mais Informações</a>
                    </div>
                  </div>
                  <div class="list-group-item">
                    <p class="text-warning"><strong>Situação: </strong>submetida</p>
                    <p><strong>Título da Obra: </strong>Título</p>
                    <p><strong>Subtítulo da Obra: </strong>Subtítulo</p>
                    <p><strong>Descrição: </strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <p><small>Submetida em 09/11/2017</small></p>
                  </div>
                </div>
              </div> <!-- painel-lista -->

              @foreach($propostas as $proposta)
              <div class="painel-lista">
                <!-- List group -->
                <ul class="list-group">
                  <li class="list-group-item titulo-lista">
                    <span class="glyphicon glyphicon-book glyphicon-space"></span>Proposta
                    <div class="pull-right">
                      <a href="{!! action('PropostasController@show', $proposta->cod_proposta) !!}">Mais Informações</a>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <p class="text-warning"><strong>Situação: </strong>COLOCAR AQUI A SITUAÇÃO DA PROPOSTA</p>
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

    </div> <!-- row -->
  </div> <!--container -->
</div> <!-- content -->
@endrole
@endsection
