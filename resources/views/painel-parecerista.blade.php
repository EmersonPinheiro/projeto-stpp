@extends('master')
@section('title', 'Propostas')

@section('content')

@role('parecerista')
<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">

      @foreach ($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
      @endforeach

      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif

      <!--TODO: Implementar função para parecerista se tornar propositor-->

      <!-- PAINEL PRINCIPAL -->
      <div class="col-md-10 col-md-offset-1">
        <div class="quadro-painel painel-propostas">
          <div class="panel panel-default">
            <!-- CABEÇALHO PAINEL -->
            <div class="panel-heading">
              <span class="panel-title"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;&nbsp;Lista de Pareceres</span>
            </div>
            <div class="panel-body">
              <!-- LISTA DE PROPOSTAS -->
              <div class="painel-lista">
                <!-- List group -->
                <ul class="list-group">
                  @if($obrasPareceres->isEmpty())
                  <div class="alert alert-info" role="alert">
                    <p>Não há propostas a serem avaliadas.</p>
                  </div>
                  @else

                  @foreach($obrasPareceres as $obra)
                  <li class="list-group-item titulo-lista">
                    <span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;Proposta 1
                    <div class="pull-right">
                      @if($obra->prazo_restante > 0)
                      <strong><a href="{!! action('ParecerController@create', $obra->cod_parecer) !!}">Enviar Parecer</a>
                        @if(!$obra->envio)
                          (Restam {!! $obra->prazo_restante !!} dias!)
                        @else
                          (Parecer enviado!)
                        @endif
                          </strong>
                      @else
                      <strong>Seu prazo acabou!</strong> <a href="#">Clique para solicitar um prazo maior.</a>
                      @endif
                    </div>
                  </li>
                  <li class="list-group-item">
                    <p><strong>Título da Obra: </strong>{!! $obra->titulo !!}</p>
                    <p><strong>Subtítulo da Obra: </strong>{!! $obra->subtitulo !!}</p>
                    <p><strong>Descrição: </strong>{!! $obra->descricao !!}</p>
                  </li>

                    @endforeach

                  @endif
                </ul>
              </div> <!-- painel-lista -->
              <!-- FIM LISTA DE PROPOSTAS -->
            </div> <!-- panel-body -->
          </div> <!-- panel -->
        </div> <!-- quadro-painel painel-propostas -->
      </div> <!-- col -->

    </div> <!-- row -->
  </div> <!--container -->
</div> <!-- content -->
@endrole
@endsection
