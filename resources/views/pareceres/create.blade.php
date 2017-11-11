@extends('master')
@section('title', 'Enviar parecer')

@section('content')
<!-- CONTENT -->



<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="quadro-painel painel-info-proposta">
          <div class="panel panel-default">
            <!-- CABEÇALHO PAINEL -->
            <div class="panel-heading">
              <span class="panel-title"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;{!! $obraParecer->titulo !!}</span>
            </div>

            @foreach ($errors->all() as $error)
            <br>
            <div class="alert alert-danger">
              <p>{{ $error }}</p>
            </div>
            @endforeach

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="panel-body text-justify">
              <a href="/painel-parecerista"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel</a>
              <h4 class="titulo">Informações da Obra</h4>
              <p><strong>Título da Obra: </strong>{!! $obraParecer->titulo !!}</p>
              <p><strong>Subtítulo da Obra: </strong>{!! $obraParecer->subtitulo !!}</p>
              <p><strong>Descrição: </strong>{!! $obraParecer->descricao !!}</p>
              <p><strong>Documento: </strong>documento.doc<a href="{!! action('MaterialController@downloadMaterial', $idMaterial) !!}">&nbsp;&nbsp;&nbsp;Baixar </a>| <a href="{!! action('MaterialController@showMaterial', $idMaterial) !!}">Visualizar PDF</a></p><br>
              <p><strong class="alert alert-danger">Dias restantes: {!! $obraParecer->prazo_restante !!}</strong></p>
              <h4 class="titulo">Parecer</h4>
              <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="form-group">
                  <label for="cad7">Parecer (.pdf)</label>
                  <input type="file" name="parecer" class="form-control" id="cad7">
                </div>
                <div class="form-group">
                  <label for="cad4">Observações</label>
                  <textarea type="text" class="form-control" id="cad4" placeholder="Observações"></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span>&nbsp;&nbsp;&nbsp;Enviar Parecer</button>
              </form>
            </div>
            <div class="panel-footer">
              <a href="/painel-parecerista"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel</a>
            </div>
          </div> <!-- painel -->
        </div> <!-- /quadro-painel /painel-info-propostas -->
      </div> <!-- /col -->
    </div> <!-- /row -->
  </div> <!-- /container -->
</div> <!-- /content -->
@endsection
