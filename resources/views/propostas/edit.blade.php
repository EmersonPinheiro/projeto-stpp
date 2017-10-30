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
                <div class="form-group col-md-12">
                  <label>Resumo</label>
                  <textarea type="text" id="resumo" name="resumo" class="form-control" >{!! $obra->resumo !!}</textarea>
                </div>
                <div class="form-group col-md-12">
                  <label>Palavras-chave</label>
                  @foreach($palavrasChave as $palavraChave)
                    <textarea type="text" id="palavra" name="palavra" class="form-control" >{!! $palavraChave->palavra !!}</textarea>
                  @endforeach
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

                <!-- IMPLEMENTAR EDIÇÃO PARA OS CAMPOS SEGUINTES -->
                <div class="form-group col-md-6">
                  <label for="cad6">ISBN</label>
                  <input type="text" class="form-control" id="cad6" value="{!! $obra->isbn !!}">
                </div>
                <h4 class="titulo">Informações Adicionais</h4>
                <div class="form-group col-md-3">
                  <label>Edição</label>
                  <input type="text" class="form-control" >
                </div>
                <div class="form-group col-md-3">
                  <label>Volume</label>
                  <input type="text" class="form-control" value="{!! $obra->volume !!}">
                </div>
                <div class="form-group col-md-3">
                  <label>Ano</label>
                  <input type="text" class="form-control" value="{!! $obra->ano_publicacao !!}">
                </div>
                <div class="form-group col-md-3">
                  <label>Número de Páginas</label>
                  <input type="text" class="form-control" value="{!! $obra->num_paginas !!}">
                </div>
                <div class="form-group col-md-6">
                  <label>Parecerista</label>
                  <input type="text" class="form-control" placeholder="Parecerista">
                </div>
                <div class="form-group col-md-6">
                  <label>Revisor Ortográfico</label>
                  <input type="text" class="form-control" placeholder="Revisor Ortográfico">
                </div>
                <div class="form-group col-md-6">
                  <label>Revisor de Idioma (Inglês)</label>
                  <input type="text" class="form-control" placeholder="Revisor de Idioma (Inglês)">
                </div>
                <div class="form-group col-md-6">
                  <label>Revisor de Idioma (Espanhol)</label>
                  <input type="text" class="form-control" placeholder="Revisor de Idioma (Espanhol)">
                </div>
                <div class="form-group col-md-6">
                  <label>Diagramador</label>
                  <input type="text" class="form-control" placeholder="Diagramador">
                </div>
                <div class="form-group col-md-6">
                  <label>Criador Capa</label>
                  <input type="text" class="form-control" placeholder="Criador Capa">
                </div>
                <div class="form-group col-md-6">
                  <label>Projetista Gráfico</label>
                  <input type="text" class="form-control" placeholder="Projetista Gráfico">
                </div>
                <div class="form-group col-md-6">
                  <label>Coordenação Editorial</label>
                  <input type="text" class="form-control" placeholder="Coordenação Editorial">
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
