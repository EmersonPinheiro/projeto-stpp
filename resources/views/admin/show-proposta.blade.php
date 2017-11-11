@extends('master')
@section('title', 'Informações da obra')

@section('content')

<!-- CONTENT -->
<div class="content">

<div class="">
  <span><strong><h2>&nbsp;&nbsp;&nbsp;ÁREA DO ADMINISTRADOR</h2></strong></span>
</div>


  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="quadro-painel painel-info-proposta">
          <div class="panel panel-default">
            <!-- CABEÇALHO PAINEL -->
            <div class="panel-heading">
              <span class="panel-title"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;{{$obra->titulo}}</span>
            </div>

            <div class="panel-body text-justify">
              <div class="pull-right">
                <a class="btn btn-primary" href="{!! action('AdminController@edit', $obra->Proposta_cod_proposta) !!}" role="button"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;&nbsp;Editar Proposta</a>
                <a href="" role="button" class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;&nbsp;Excluir proposta</a>
              </div>

              @foreach ($errors->all() as $error)
                  <p class="alert alert-danger">{{ $error }}</p>
              @endforeach

              @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif

              <a href="/admin/painel-administrador"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>
              <h4 class="titulo">Informações da Obra</h4>
              <p><strong>Título da Obra: </strong>{!! $obra->titulo !!}</p>
              <p><strong>Subtítulo da Obra: </strong>{!! $obra->subtitulo !!}</p>

              <p><strong>Autor(es):
              @foreach($autores as $autor)
                </strong>{!! $autor->nome !!} {!! $autor->sobrenome !!}</p>
              @endforeach
              <p><strong>Descrição: </strong>{!! $obra->descricao !!}</p>
              <p><strong>Resumo: </strong>{!! $obra->resumo !!}</p>
              <p><strong>Palavras-chave:

              @foreach($palavrasChave as $palavraChave)
                </strong>{!! $palavraChave->palavra !!}</p>
              @endforeach

              <h2>Situação: {!! $proposta->situacao !!}</h2>

              <h4 class="titulo">Informações Adicionais</h4>
              <p><strong>ISBN: </strong>{!! $obra->isbn !!}</p>
              <p><strong>Edição: </strong>1ª</p><!--VEM DO MATERIAL-->
              <p><strong>Volume: </strong>{!! $obra->volume !!}</p>
              <p><strong>Ano: </strong>{!! $obra->ano_publicacao !!}</p>
              <p><strong>Número de Páginas: </strong>{!! $obra->num_paginas !!}</p>

              @if($funcoes['diagramador'] != null)<!--TODO: Retirar. Está aqui só para evitar erro-->

              <p><strong>Diagramador: </strong>{!! $funcoes['diagramador']->nome !!}</p>
              <p><strong>Revisor Ortográfico: </strong>{!! $funcoes['revisor_ortografico']->nome !!}</p>
              <p><strong>Revisor de Idioma (Inglês): </strong>{!! $funcoes['revisor_ingles']->nome !!}</p>
              <p><strong>Revisor de Idioma (Espanhol): </strong>{!! $funcoes['revisor_espanhol']->nome !!}</p>
              <p><strong>Criador Capa: </strong>{!! $funcoes['cricador_capa']->nome !!}</p>
              <p><strong>Projetista Gráfico: </strong>{!! $funcoes['projetista_grafico']->nome !!}</p>
              <p><strong>Coordenação Editorial: </strong>{!! $funcoes['coordenacao_editorial']->nome !!}</p>
              @endif
              <p><strong>Pareceristas: </strong>João da Silva</p>

              <h4 class="titulo">Arquivos</h4>
              @foreach($materiais as $material)
                <h5><i>Versão {!! $material->versao !!}</i></h5>
                <p><strong>Documento (doc, docx): </strong>documento.doc<a href="{!! action('MaterialController@downloadMaterial', $material->cod_material) !!}">&nbsp;&nbsp;&nbsp;Baixar </a></p>
                <p><strong>Imagens (zip, rar): </strong>imagens.zip<a href="">&nbsp;&nbsp;&nbsp;Baixar </a></p>
              @endforeach

              <strong><a href="{!! action('ConviteController@invite', $obra->Proposta_cod_proposta) !!}">Clique aqui para convidar um avaliador para esta obra.</a></strong>

            </div>
            <div class="panel-footer">
              <a href="/admin/painel-administrador"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>
            </div>
          </div> <!-- painel -->
        </div> <!-- /quadro-painel /painel-info-propostas -->
      </div> <!-- /col -->
    </div> <!-- /row -->
  </div> <!-- /container -->
</div> <!-- /content -->

@endsection
