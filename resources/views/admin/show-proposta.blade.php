@extends('master')
@section('title', 'Informações da obra')

@section('content')

<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="quadro text-justify">

          <a href="/admin/painel-administrador"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>
          <h3><span class="glyphicon glyphicon-book glyphicon-space"></span>{{$obra->titulo}}</h3>

          @if (!$errors->isEmpty())
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <p><span class="glyphicon glyphicon-exclamation-sign glyphicon-space"></span>
              Ops! Algo deu errado.</p>
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          @if (session('status'))
              <div class="alert alert-info">
                  {{ session('status') }}
              </div>
          @endif

          <h4 class="titulo">Informações da Obra</h4>
          <p class="alert alert-warning alert-trim"><strong>Situação: </strong>{!! $proposta->situacao !!}</p>
          <p><strong>Título da Obra: </strong>{!! $obra->titulo !!}</p>
          <p><strong>Subtítulo da Obra: </strong>{!! $obra->subtitulo !!}</p>
          <p><strong>Autor(es):
          @foreach($autores as $autor)
            </strong>{!! $autor->nome !!} {!! $autor->sobrenome !!}</p>
          @endforeach
          <p><strong>Descrição: </strong>{!! $obra->descricao !!}</p>
          <button type="button" name="button" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-down glyphicon-space"></span>Informações Adicionais</button>
          <button type="button" name="button" class="btn btn-success"><span class="glyphicon glyphicon-plus glyphicon-space"></span>Cadastrar Informações Adicionais</button>

          <!-- <p><strong>ISBN: </strong>{!! $obra->isbn !!}</p>
          <p><strong>Edição: </strong>1ª</p>
          <p><strong>Volume: </strong>{!! $obra->volume !!}</p>
          <p><strong>Ano: </strong>{!! $obra->ano_publicacao !!}</p>
          <p><strong>Número de Páginas: </strong>{!! $obra->num_paginas !!}</p>

          @if($funcoes['diagramador'] != null)<!--TODO: Retirar. Está aqui só para evitar erro

          <p><strong>Diagramador: </strong>{!! $funcoes['diagramador']->nome !!}</p>
          <p><strong>Revisor Ortográfico: </strong>{!! $funcoes['revisor_ortografico']->nome !!}</p>
          <p><strong>Revisor de Idioma (Inglês): </strong>{!! $funcoes['revisor_ingles']->nome !!}</p>
          <p><strong>Revisor de Idioma (Espanhol): </strong>{!! $funcoes['revisor_espanhol']->nome !!}</p>
          <p><strong>Criador Capa: </strong>{!! $funcoes['cricador_capa']->nome !!}</p>
          <p><strong>Projetista Gráfico: </strong>{!! $funcoes['projetista_grafico']->nome !!}</p>
          <p><strong>Coordenação Editorial: </strong>{!! $funcoes['coordenacao_editorial']->nome !!}</p>
          @endif
          <p><strong>Pareceristas: </strong>João da Silva</p> -->

          <h4 class="titulo">Arquivos</h4>
          @foreach($materiais as $material)
            <h5><i>Versão {!! $material->versao !!}</i></h5>
            <p><strong>Documento (doc, docx): </strong>documento.doc<a href="{!! action('MaterialController@downloadMaterial', $material->cod_material) !!}">&nbsp;&nbsp;&nbsp;Baixar </a></p>
            <p><strong>Imagens (zip, rar): </strong>imagens.zip<a href="">&nbsp;&nbsp;&nbsp;Baixar </a></p>
          @endforeach
          <hr>

          <div class="row">
            <div class="col-md-12">
              <div class="pull-right">
                <a href="" role="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove glyphicon-space"></span>Excluir proposta</a>
                <a class="btn btn-primary" href="{!! action('AdminController@edit', $obra->Proposta_cod_proposta) !!}" role="button"><span class="glyphicon glyphicon-pencil glyphicon-space"></span>Editar Proposta</a>
                <a href="{!! action('ConviteController@invite', $obra->Proposta_cod_proposta) !!}" role="button" class="btn btn-primary"><span class="glyphicon glyphicon-send glyphicon-space"></span>Convidar Avalidador</a>
              </div>
            </div>
          </div>

          <a href="/admin/painel-administrador"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>

        </div> <!-- /quadro -->
      </div> <!-- /col -->
    </div> <!-- /row -->
  </div> <!-- /container -->
</div> <!-- /content -->

@endsection
