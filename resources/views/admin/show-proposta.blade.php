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
          <p class="alert {{ $proposta->situacao != 'Cancelada' ? 'alert-warning' : 'alert-danger' }} alert-trim"><strong>Situação: </strong>{!! $proposta->situacao !!}</p>
          <p><strong>Título da Obra: </strong>{!! $obra->titulo !!}</p>
          <p><strong>Subtítulo da Obra: </strong>{!! $obra->subtitulo !!}</p>
          <p><strong>Autor(es):</strong></p>
          @foreach($autores as $autor)
            <p>{!! $autor->nome !!} {!! $autor->sobrenome !!}</p>
          @endforeach
          <p><strong>Resumo: </strong>{!! $obra->resumo !!}</p>
          <p><strong>Gênese e relevância: </strong>{!! $obra->genese_relevancia !!}</p>

          <button type="button" name="button" id="info-adicionais" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-down glyphicon-space"></span> Informações Adicionais</button>
          @if($proposta->situacao != 'Cancelada')
            <button type="button" name="button" class="btn btn-success"><span class="glyphicon glyphicon-plus glyphicon-space"></span>Cadastrar Informações Adicionais</button>
          @endif

          <div class="invisivel">
            <h4 class="titulo">Informações Adicionais</h4>
            @if($obra->isbn == null and $obra->edicao == null and $obra->volume == null and $obra->ano_publicacao == null and $obra->num_paginas == null and $tecnicos->isEmpty())<p class="alert alert-info">Nenhuma informação adicional foi cadastrada pelo Administrador até o momento.</p>@endif
            @if($obra->isbn != null)<p><strong>ISBN: </strong>{!! $obra->isbn !!}</p>@endif
            @if($obra->edicao != null)<p><strong>Edição: </strong>{!! $obra->edicao !!}</p>@endif
            @if($obra->volume != null)<p><strong>Volume: </strong>{!! $obra->volume !!}</p>@endif
            @if($obra->ano_publicacao != null)<p><strong>Ano: </strong>{!! $obra->ano_publicacao !!}</p>@endif
            @if($obra->num_paginas != null)<p><strong>Número de Páginas: </strong>{!! $obra->num_paginas !!}</p>@endif

            @if($funcoes['diagramador'] != null)<p><strong>Diagramador: </strong>{!! $funcoes['diagramador']->nome !!}</p>@endif
            @if($funcoes['revisor_ortografico'] != null)<p><strong>Revisor Ortográfico: </strong>{!! $funcoes['revisor_ortografico']->nome !!}</p>@endif
            @if($funcoes['revisor_ingles'] != null)<p><strong>Revisor de Idioma (Inglês): </strong>{!! $funcoes['revisor_ingles']->nome !!}</p>@endif
            @if($funcoes['revisor_espanhol'] != null)<p><strong>Revisor de Idioma (Espanhol): </strong>{!! $funcoes['revisor_espanhol']->nome !!}</p>@endif
            @if($funcoes['criador_capa'] != null)<p><strong>Criador Capa: </strong>{!! $funcoes['criador_capa']->nome !!}</p>@endif
            @if($funcoes['projetista_grafico'] != null)<p><strong>Projetista Gráfico: </strong>{!! $funcoes['projetista_grafico']->nome !!}</p>@endif
            @if($funcoes['coordenacao_editorial'] != null)<p><strong>Coordenação Editorial: </strong>{!! $funcoes['coordenacao_editorial']->nome !!}</p>@endif
            @if(!$pareceristasPareceres->isEmpty())
              <strong>Parecerista(s): </strong>
              @foreach($pareceristasPareceres as $pareceristaParecer)
                <p>{!! $pareceristaParecer->nome !!} </p>
              @endforeach
            @endif
          </div>

          <h4 class="titulo">Arquivos</h4>
          <div class="row">
            <div class="col-md-12">
              <h5 class="titulo">Material
                <!-- AJUDA -->
                <small><a href="javascript:;" data-toggle="popover" data-content="Abaixo são exibidos os documentos com e sem identificação e o arquivo compactado das imagens enviados para a proposta. Você pode solicitar uma nova versão dos documentos através do botão 'Solicitar Nova Versão da Obra'." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small></h5>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Versão</th>
                    <th>Documento com Identificação</th>
                    <th>Documento sem Identificação</th>
                    <th>Imagens</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($materiais as $material)
                  <tr>
                    <td>{!! $material->versao !!}</td>
                    <td><a href="{!! action('DocumentosController@downloadMaterialIdentificado', $material->cod_material) !!}">Baixar</a></td>
                    <td><a href="{!! action('DocumentosController@downloadMaterialNaoIdentificado', $material->cod_material) !!}">Baixar</a></td>
                    <td>
                    @if($material->url_imagens != null)
                      <a href="{!! action('DocumentosController@downloadImagens', $material->cod_material) !!}">Baixar</a>
                    @else
                      Não há imagens
                    @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @if($proposta->situacao != 'Cancelada')
                <button class="btn btn-primary" role="button" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-file glyphicon-space"></span>Solicitar Nova Versão da Obra</button>
              @endif
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <h5 class="titulo">Documentos de Sugestão de Alterações
                <!-- AJUDA -->
                <small><a href="javascript:;" data-toggle="popover" data-content="Abaixo são exibidos os documentos de sugestão de alterações enviados no sistema. Você pode enviar um novo documento quando solicita uma nova versão da obra através do botão 'Solicitar nova versão da Obra'." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small></h5>
              @if(!$docsSugestoes->isEmpty())
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Versão</th>
                      <th>Documento</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($docsSugestoes as $docSugestao)
                      <td>{!! $docSugestao->versao !!}</td>
                      <td><a href="{!! action('DocumentosController@showDocSugestao', $docSugestao->cod_sug_alteracoes) !!}">Visualizar</a></td>
                    @endforeach
                  </tbody>
                </table>
              @else
                <p class="alert alert-info">Nenhuma alteração foi sugerida até o momento.</p>
              @endif
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <h5 class="titulo">Ofícios de Alteração
                <!-- AJUDA -->
                <small><a href="javascript:;" data-toggle="popover" data-content="Abaixo são exibidos os oficios de alteração enviados em complemento às novas versões da obra." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small></h5>
              @if(!$oficiosAlteracoes->isEmpty())
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Versão</th>
                      <th>Documento</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($oficiosAlteracoes as $oficioAlteracao)
                      <td>{!! $oficioAlteracao->versao !!}</td>
                      <td><a href="{!! action('DocumentosController@showOficioAlteracao', $oficioAlteracao->cod_oficio) !!}" target="_blank">Visualizar</a></td>
                    @endforeach
                  </tbody>
                </table>
              @else
                <p class="alert alert-info">Nenhum ofício foi enviado até o momento.</p>
              @endif
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <h5 class="titulo">Pareceres</h5>
              @if(!$pareceristasPareceres->isEmpty())
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Avaliador</th>
                      <th>Documento de Pareceres</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pareceristasPareceres as $pareceristaParecer)
                    <td><a href="{!! action('PerfilController@show', $pareceristaParecer->slug) !!}">{!! $pareceristaParecer->nome !!} {!! $pareceristaParecer->sobrenome !!}</a></td>
                      <td>
                        @if($pareceristaParecer->envio)
                          <a class="col-md-4" href="{!! action('ParecerController@show', $pareceristaParecer->cod_parecer) !!}" target="_blank">Visualizar</a>
                        @else
                          @if($pareceristaParecer->prazo_restante == 0 and $proposta->situacao != 'Cancelada')
                            <a class="btn btn-primary" href="{!! action('ParecerController@prorrogarPrazo', $pareceristaParecer->cod_parecer) !!}">Prorrogar Prazo em 30 dias</a>
                          @else
                            <p>Parecer ainda não enviado.</p>
                          @endif
                        @endif
                      </td>
                    @endforeach
                  </tbody>
                </table>
              @else
                <p class="alert alert-info">Nenhum Avaliador foi convidado para esta obra.</p>
              @endif
              @if($proposta->situacao != 'Cancelada')
                <a href="{!! action('ConviteController@invite', $obra->Proposta_cod_proposta) !!}" role="button" class="btn btn-primary"><span class="glyphicon glyphicon-send glyphicon-space"></span>Convidar Avalidador</a>
              @endif
            </div>
          </div>

          <hr/>
          <div class="row">
            <div class="col-md-12">
              <div class="pull-right">
                <a class="btn btn-primary" href="{!! action('RelatorioController@index', $proposta->cod_proposta) !!}" role="button"><span class="glyphicon glyphicon-file glyphicon-space"></span>Gerar Relatório</a>
                @if($proposta->situacao != 'Cancelada')
                  <a class="btn btn-primary" href="{!! action('AdminController@edit', $obra->Proposta_cod_proposta) !!}" role="button"><span class="glyphicon glyphicon-pencil glyphicon-space"></span>Editar Proposta</a>
                  <button class="btn btn-danger" role="button" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-remove glyphicon-space"></span>Cancelar Proposta</button>
                @endif
              </div>
            </div>
          </div>

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

    <!-- MODAL SOLICITAR NOVA VERSÃO -->
    <div class="modal fade" id="myModal2">
      <div class="modal-dialog modal-sm"> <!-- modal-sm, modal-lg -->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span arua-hidden="true">&times;</span></button>
            <h4 class="modal-title">Cancelar Proposta</h4>
          </div>
          <div class="modal-body">
            <p class="text-center">Tem certeza que deseja cancelar esta Proposta?</p>
            <div class="row">
              <div class="col-md-6 text-center">
                <a href="{!! action('AdminController@cancelarProposta', $obra->Proposta_cod_proposta) !!}" role="button" class="btn btn-success">Sim</a>
              </div>
              <div class="col-md-6 text-center">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Não</button>
              </div>
            </div>
          </div>
        </div> <!-- modal-content -->
      </div> <!-- modal-dialog -->
    </div>

  </div> <!-- /container -->
</div> <!-- /content -->

@endsection
