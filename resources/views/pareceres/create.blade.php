@extends('master')
@section('title', 'Informações da obra')

@section('content')

<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="quadro text-justify">

          <a href="/painel-parecerista"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel</a>

          <h3><span class="glyphicon glyphicon-book glyphicon-space"></span><strong>{{$obraParecer->titulo}}</strong></h3>

          @if (!$errors->isEmpty())
            <div class="alert alert-danger">
              <p><span class="glyphicon glyphicon-exclamation-sign glyphicon-space"></span>
              <strong>Ops! Algo deu errado.</strong></p>
              @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
              @endforeach
            </div>
          @endif

          @if (session('status'))
              <div class="alert alert-info">
                  {{ session('status') }}
              </div>
          @endif

          <h4 class="titulo">Informações da Obra</h4>
          @if(!$obraParecer->envio)
            <div class="alert alert-danger alert-trim">
              <strong>Restam {!! $obraParecer->prazo_restante !!} dias para o envio do parecer.</strong></p>
            </div>
            @if($obraParecer->prazo_restante == 0)
              <br><p><strong><a href="{!! action('ParecerController@solicitarPrazo', $obraParecer->cod_parecer) !!}">Clique para solicitar prorrogação do prazo.</a></p>
            @endif
          @else
            <div  class="alert alert-success alert-trim">
              <p>Parecer enviado!</p>
            </div>
          @endif

          <p><strong>Título da Obra: </strong>{!! $obraParecer->titulo !!}</p>
          <p><strong>Subtítulo da Obra: </strong>{!! $obraParecer->subtitulo !!}</p>
          <p><strong>Resumo: </strong>{!! $obraParecer->resumo !!}</p>
          <p><strong>Material: </strong><a href="{!! action('DocumentosController@showMaterialParecerista', $idMaterial) !!}">clique aqui para visualizar ou baixar documento</a><br>

          <form method="post" enctype="multipart/form-data">
            <fieldset>
              <legend>Parecer</legend>
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="form-group">
                  <label for="parecer">Parecer (.pdf)</label>
                  <input type="file" name="parecer" class="form-control" id="parecer" accept="application/pdf">
                </div>
                <div class="form-group">
                  <label for="obs">Observações</label>
                  <textarea type="text" class="form-control" id="obs" name="obs" placeholder="Observações"></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-cloud-upload glyphicon-space"></span>Enviar Parecer</button>
            </fieldset>
          </form>
          <hr>

        </div>

      </div> <!-- /col -->
    </div> <!-- /row -->
  </div> <!-- /container -->
</div> <!-- /content -->
@endsection
