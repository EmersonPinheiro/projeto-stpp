@extends('master')
@section('title', 'Enviar proposta')

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
              <span class="panel-title"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;&nbsp;Editar Proposta</span>
            </div>

            <div class="panel-body text-justify">
              <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>
              <form method="post">

                <input type="hidden" name="_token" value="{!! csrf_token() !!}">


                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <h4 class="titulo">Informações da Obra</h4>
                <div class="form-group col-md-6">
                  <label>Título</label>
                  <input type="text" class="form-control" id="titulo" name="titulo" value="{!! $obra->titulo !!}">
                </div>
                <div class="form-group col-md-6">
                  <label>Subtítulo</label>
                  <input type="text" class="form-control" id="subtitulo" name="subtitulo" value="{!! $obra->subtitulo !!}">
                </div>
                <div class="form-group col-md-12">
                  <label>Descrição</label>
                  <textarea type="text" id="descricao" name="descricao" class="form-control" >{!! $obra->descricao !!}</textarea>
                </div>

                <div class="form-group col-md-6">
                  <label for="cad5">Autor</label>
                  @foreach($autores as $autor)
                  <label>Nome</label>
                    <input type="text" class="form-control" id="cad5" name="nome" value="{!! $autor->nome !!}">
                  <label>Sobrenome</label>
                    <input type="text" class="form-control" id="cad5" name="sobrenome" value="{!! $autor->sobrenome !!}">
                  @endforeach
                </div>

                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary btn-block">Salvar</button>
                </div>
              </form>
            </div>
            <div class="panel-footer">
              <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>
            </div>
          </div> <!-- painel -->
        </div> <!-- /quadro-painel /painel-info-propostas -->
      </div>
    </div>
  </div> <!--container -->
</div> <!-- content -->
@endsection
