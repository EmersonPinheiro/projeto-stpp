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

<<<<<<< HEAD


            <div class="panel-body text-justify">
              <div class="pull-right">
                @if($proposta->ativa == 1)
                <a class="btn btn-primary" href="{!! action('AdminController@edit', $obra->Proposta_cod_proposta) !!}" role="button"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;&nbsp;Editar Proposta</a>
                <a href="{!! action('AdminController@cancelarProposta', $obra->Proposta_cod_proposta) !!}" role="button" class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;&nbsp;Cancelar proposta</a>
                @else
                <h5>Proposta CANCELADA!</h5>
                @endif
                <a class="btn btn-primary" href="{!! action('RelatorioController@index', $proposta->cod_proposta) !!}" role="button"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;Relatório</a>
=======
          @if (session('status'))
              <div class="alert alert-info">
                  {{ session('status') }}
>>>>>>> eb1d070bfd786340369a50316a061c0c8f7ba6de
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

<<<<<<< HEAD
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

              <h2>Situação: {!! $proposta->situacao !!}</h2>

              <h4 class="titulo">Informações Adicionais</h4>
              <p><strong>ISBN: </strong>{!! $obra->isbn !!}</p>
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

              <strong>Parecerista(s): </strong>
              @foreach($pareceristasPareceres as $pareceristaParecer)
                <p>{!! $pareceristaParecer->nome !!} </p>
              @endforeach

              <div class="row">
                <h4 class="titulo">Arquivos</h4>

                <div class="col-md-4">
                  <h5 class="titulo">Material</h5>

                  @foreach($materiais as $material)
                    <h5><i>Versão {!! $material->versao !!}</i></h5>
                    <p>&nbsp;&nbsp;&nbsp;<strong><a href="{!! action('DocumentosController@downloadMaterial', $material->cod_material) !!}">Baixar documento</a></strong></p>
                    <p><strong>Imagens (zip, rar): </strong>imagens.zip<a href="">&nbsp;&nbsp;&nbsp;Baixar </a></p>
                  @endforeach

                  <div class="">
                    <a class="btn btn-primary" role="button" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;Solicitar nova versão</a>
                  </div>
                </div>

                <div class="col-md-4">
                  <h5 class="titulo">Docs. de Sugestão de Alterações</h5>
                  @if(!$docsSugestoes->isEmpty())
                    @foreach($docsSugestoes as $docSugestao)
                      <h5><i>Versão {!! $docSugestao->versao !!}</i></h5>
                      <p><strong>&nbsp;<a href="{!! action('DocumentosController@showDocSugestao', $docSugestao->cod_sug_alteracoes) !!}">Visualizar documento</a></strong></p>
                    @endforeach
                  @else
                    <p>Nenhuma alteração foi sugerida ainda.</p>
                  @endif
                </div>

                <div class="col-md-4">
                  <h5 class="titulo">Ofícios de Alterações</h5>
                  @if(!$oficiosAlteracoes->isEmpty())
                    @foreach($oficiosAlteracoes as $oficioAlteracao)
                      <h5><i>Versão {!! $oficioAlteracao->versao !!}</i></h5>
                      <p><strong>&nbsp;<a href="{!! action('DocumentosController@showOficioAlteracao', $oficioAlteracao->cod_oficio) !!}">Visualizar documento</a></strong></p>
                    @endforeach
                  @else
                    <p>Nenhuma ofício foi enviado ainda.</p>
                  @endif
                </div>
            </div>
=======
                <a href="" role="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove glyphicon-space"></span>Excluir proposta</a>
                <a class="btn btn-primary" href="{!! action('AdminController@edit', $obra->Proposta_cod_proposta) !!}" role="button"><span class="glyphicon glyphicon-pencil glyphicon-space"></span>Editar Proposta</a>
                <a href="{!! action('ConviteController@invite', $obra->Proposta_cod_proposta) !!}" role="button" class="btn btn-primary"><span class="glyphicon glyphicon-send glyphicon-space"></span>Convidar Avalidador</a>
>>>>>>> eb1d070bfd786340369a50316a061c0c8f7ba6de

              </div>
            </div>
          </div>
          <a href="/admin/painel-administrador"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>
          
        </div> <!-- /quadro -->
      </div> <!-- /col -->
    </div> <!-- /row -->

    <!-- MODAL SOLICITAR NOVA VERSÃO -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog"> <!-- modal-sm, modal-lg -->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span arua-hidden="true">&times;</span></button>
            <h4 class="modal-title">Solicitar Nova Versão da Obra</h4>
          </div>
          <div class="modal-body">
            <form action="{!! route('solicitarNovaVersao', $proposta->cod_proposta) !!}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <input type="hidden" name="cod_proposta" value="{!! $proposta->cod_proposta !!}">

              <div class="form-group">
                <label for="doc_sugestao">Documento de sugestão de alterações (.pdf)</label>
                <input type="file" class="form-control" id="doc_sugestao" name="doc_sugestao">
              </div>
              <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-primary" value="Enviar">
              </div>
            </form>
          </div>
        </div> <!-- modal-content -->
      </div> <!-- modal-dialog -->
    </div>


  </div> <!-- /container -->
</div> <!-- /content -->

@endsection
