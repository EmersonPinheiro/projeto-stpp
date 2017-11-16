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
<<<<<<< HEAD


=======
>>>>>>> 548c029de052b275561505cb2778d8b358190a62

            <div class="panel-body text-justify">
              <div class="pull-right">
                @if($proposta->ativa == 1)
                <a class="btn btn-primary" href="{!! action('AdminController@edit', $obra->Proposta_cod_proposta) !!}" role="button"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;&nbsp;Editar Proposta</a>
                <a href="{!! action('AdminController@cancelarProposta', $obra->Proposta_cod_proposta) !!}" role="button" class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;&nbsp;Cancelar proposta</a>
                @else
                <h5>Proposta CANCELADA!</h5>
                @endif
<<<<<<< HEAD
                <a class="btn btn-primary" href="{!! action('RelatorioController@index', $proposta->cod_proposta) !!}" role="button"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;Relatório</a>
=======
>>>>>>> 548c029de052b275561505cb2778d8b358190a62
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
                <div class="col-md-12">
                  <h5 class="titulo">Material</h5>

                <div class="pull-right">
                  <a class="btn btn-primary" role="button" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;Solicitar nova versão</a>
                </div>

                  @foreach($materiais as $material)
                  <h5><i>Versão {!! $material->versao !!}</i></h5>
                  <p><strong>Documento (doc, docx): </strong>documento.doc<a href="{!! action('MaterialController@downloadMaterial', $material->cod_material) !!}">&nbsp;&nbsp;&nbsp;Baixar </a></p>
                  <p><strong>Imagens (zip, rar): </strong>imagens.zip<a href="">&nbsp;&nbsp;&nbsp;Baixar </a></p>
                  @endforeach
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <h5 class="titulo">Pareceres</h5>
                  @foreach($pareceristasPareceres as $pareceristaParecer)
                    <p class="col-md-8">Parecer de {!! $pareceristaParecer->nome !!} {!! $pareceristaParecer->sobrenome !!}:</p>
                    @if($pareceristaParecer->envio)
                      <a class="col-md-4" href="{!! action('ParecerController@show', $pareceristaParecer->cod_parecer) !!}">Visualizar</a>
                    @else
                      @if($pareceristaParecer->prazo_restante == 0)
                        <a class="col-md-4" href="{!! action('ParecerController@prorrogarPrazo', $pareceristaParecer->cod_parecer) !!}">Prorrogar prazo por mais 30 dias</a>
                      @else
                        <p>Parecer ainda não enviado.</p>
                      @endif
                    @endif
                  @endforeach
                </div>
              </div>

<<<<<<< HEAD
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

              <div class="row">
                <div class="col-md-12">
                  <h5 class="titulo">Pareceres</h5>
                  @foreach($pareceristasPareceres as $pareceristaParecer)
                    <p class="col-md-8">Parecer de {!! $pareceristaParecer->nome !!} {!! $pareceristaParecer->sobrenome !!}:</p>
                    @if($pareceristaParecer->envio)
                      <a class="col-md-4" href="{!! action('ParecerController@show', $pareceristaParecer->cod_parecer) !!}">Visualizar</a>
                    @else
                      @if($pareceristaParecer->prazo_restante == 0)
                        <a class="col-md-4" href="{!! action('ParecerController@prorrogarPrazo', $pareceristaParecer->cod_parecer) !!}">Prorrogar prazo por mais 30 dias</a>
                      @else
                        <p>Parecer ainda não enviado.</p>
                      @endif
                    @endif
                  @endforeach
                </div>
              </div>


=======

>>>>>>> 548c029de052b275561505cb2778d8b358190a62
              <strong><a href="{!! action('ConviteController@invite', $obra->Proposta_cod_proposta) !!}">Clique aqui para convidar um avaliador para esta obra.</a></strong>

            </div>
            <div class="panel-footer">
              <a href="/admin/painel-administrador"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>
            </div>
          </div> <!-- painel -->
        </div> <!-- /quadro-painel /painel-info-propostas -->
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
