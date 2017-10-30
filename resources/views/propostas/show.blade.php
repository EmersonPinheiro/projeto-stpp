@extends('master')
@section('title', 'Informações da obra')

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
              <span class="panel-title"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;{{$obra->titulo}}</span>
            </div>

            <div class="panel-body text-justify">
              <div class="pull-right">
                <a class="btn btn-primary" href="{!! action('PropostasController@edit', $obra->Proposta_cod_proposta) !!}" role="button"><span class="glyphicon glyphicon-pencil"></span>&nbsp;&nbsp;&nbsp;Editar Proposta</a>
                <a href="" role="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;&nbsp;Solicitar Cancelamento da Proposta</a>
                <div class="modal fade" id="myModal2">
                  <div class="modal-dialog"> <!-- modal-sm, modal-lg -->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span arua-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Solicitar Cancelamento da Proposta</h4>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="cad3">Conte-nos o motivo do cancelamento. <span style="color:red;">*</span> </label>
                          <textarea type="textarea" class="form-control" id="cad3" placeholder="Obrigatório"></textarea>
                        </div>
                        <p>Esta ação enviará uma solicitação de cancelamento da Proposta para o Administrador do sistema. Uma vez solicidada, não poderá ser desfeita.</p>
                        <p>Deseja continuar?</p>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" data-dismiss="modal">Enviar</button>
                      </div>
                    </div> <!-- modal-content -->
                  </div> <!-- modal-dialog -->
                </div>
              </div>

              @foreach ($errors->all() as $error)
                  <p class="alert alert-danger">{{ $error }}</p>
              @endforeach

              @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif

              <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>
              <h4 class="titulo">Informações da Obra</h4>
              <p><strong>Título da Obra: </strong>{!! $obra->titulo !!}</p>
              <p><strong>Subtítulo da Obra: </strong>{!! $obra->subtitulo !!}</p>

              <p><strong>Autor(es):
              @foreach($autores as $autor)
                </strong>{!! $autor->nome !!} {!! $autor->sobrenome !!}</p>
              @endforeach
              <p><strong>Descrição: </strong>{!! $obra->descricao !!}</p>
              <p><strong>Resumo: </strong>{!! $obra->resumo !!}</p>
              <p><strong>ISBN: </strong>{!! $obra->isbn !!}</p>
              <p><strong>Palavras-chave:

              @foreach($palavrasChave as $palavraChave)
                </strong>{!! $palavraChave->palavra !!}</p>
              @endforeach

              <h2>Situação: {!! $proposta->situacao !!}</h2>

              <h4 class="titulo">Informações Adicionais</h4>
              <p><strong>Edição: </strong>1ª</p><!--VEM DO MATERIAL-->
              <p><strong>Volume: </strong>{!! $obra->volume !!}</p>
              <p><strong>Ano: </strong>{!! $obra->ano_publicacao !!}</p>
              <p><strong>Número de Páginas: </strong>{!! $obra->num_paginas !!}</p>

              <p><strong>Diagramador: </strong>João da Silva</p>
              <p><strong>Revisor Ortográfico: </strong>João da Silva</p>
              <p><strong>Revisor de Idioma (Inglês): </strong>João da Silva</p>
              <p><strong>Revisor de Idioma (Espanhol): </strong>João da Silva</p>
              <p><strong>Pareceristas: </strong>João da Silva</p>
              <p><strong>Criador Capa: </strong>João da Silva</p>
              <p><strong>Projetista Gráfico: </strong>João da Silva</p>
              <p><strong>Coordenação Editorial: </strong>João da Silva</p>

              <h4 class="titulo">Arquivos</h4>
              @foreach($materiais as $material)
                <h5><i>Versão {!! $material->versao !!}</i></h5>
                <p><strong>Documento (doc, docx): </strong>documento.doc<a href="{!! action('MaterialController@downloadMaterial', $material->cod_material) !!}">&nbsp;&nbsp;&nbsp;Baixar </a></p>
                <p><strong>Imagens (zip, rar): </strong>imagens.zip<a href="">&nbsp;&nbsp;&nbsp;Baixar </a></p>
              @endforeach

              <!--APENAS PARA O ADMINISTRADOR-->
              <h2>ÁREA DO ADMINISTRADOR</h2>

              <strong><a href="{!! action('ConviteController@invite', $obra->Proposta_cod_proposta) !!}">Clique aqui para convidar um avaliador para esta obra.</a></strong>

              <!--MODAL-->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;&nbsp;&nbsp;Enviar Nova Versão da Obra</button>

              <div class="modal fade" id="myModal">
                <div class="modal-dialog"> <!-- modal-sm, modal-lg -->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span arua-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Enviar Nova Versão da Obra</h4>
                    </div>
                    <div class="modal-body">
                      <form action="/propostas/{!! $obra->Proposta_cod_proposta !!}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="form-group">
                          <label for="novoDoc">Documento (.doc)</label>
                          <input type="file" class="form-control" id="novoDoc" name="novoDoc">

                          <input type="hidden" name="cod_obra" value="{!! $obra->cod_obra !!}">
                          <input type="hidden" name="cod_proposta" value="{!! $proposta->cod_proposta !!}">
                        </div>
                        <div class="form-group">
                          <label for="oficio">Ofício de Alterações (.doc)</label>
                          <input type="file" class="form-control" id="oficio" name="oficio">
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-default" type="button" data-dismiss="modal">Cancelar</button>
                          <input type="submit" class="btn btn-info" value="Enviar">
                        </div>
                      </form>
                    </div>

                  </div> <!-- modal-content -->
                </div> <!-- modal-dialog -->
              </div>
            </div>
            <div class="panel-footer">
              <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>
            </div>
          </div> <!-- painel -->
        </div> <!-- /quadro-painel /painel-info-propostas -->
      </div> <!-- /col -->
    </div> <!-- /row -->
  </div> <!-- /container -->
</div> <!-- /content -->

@endsection
