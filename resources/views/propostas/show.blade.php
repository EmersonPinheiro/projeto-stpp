@extends('master')
@section('title', 'Informações da obra')

@section('content')

<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="quadro text-justify">

          <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>
          <h3><span class="glyphicon glyphicon-book glyphicon-space"></span><strong>{{$obra->titulo}}</strong></h3>

          @if (!$errors->isEmpty())
            <div class="alert alert-danger">
              <p><strong>Ops! Algo deu errado.</strong></p>
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
          <p class="alert alert-warning alert-trim"><strong>Situação: </strong>{!! $proposta->situacao !!}</p>
          <p><strong>Título da Obra: </strong>{!! $obra->titulo !!}</p>
          <p><strong>Subtítulo da Obra: </strong>{!! $obra->subtitulo !!}</p>
          <p><strong>Autor(es):
          @foreach($autores as $autor)
            </strong>{!! $autor->nome !!} {!! $autor->sobrenome !!}</p>
          @endforeach
          <p><strong>Resumo: </strong>{!! $obra->resumo !!}</p>
          <p><strong>Gênese e relevância: </strong>{!! $obra->genese_relevancia !!}</p>

          <button type="button" name="button" id="info-adicionais" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-down glyphicon-space"></span> Informações Adicionais</button>

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
          </div>

          <h4 class="titulo">Arquivos</h4>

          <h5 class="titulo">Material</h5>
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
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-cloud-upload glyphicon-space"></span>Enviar nova versão da Obra</button>

          <div class="row">
            <div class="col-md-6">
              <h5 class="titulo">Documentos de Sugestão de Alterações</h5>
              @if(!$docsSugestoes->isEmpty())
                <table>
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

            <div class="col-md-6">
              <h5 class="titulo">Ofícios de Alteração</h5>
              @if(!$oficiosAlteracoes->isEmpty())
                <table>
                  <thead>
                    <tr>
                      <th>Versão</th>
                      <th>Documento</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($oficiosAlteracoes as $oficioAlteracao)
                      <td>{!! $oficioAlteracao->versao !!}</td>
                      <td><a href="{!! action('DocumentosController@showOficioAlteracao', $oficioAlteracao->cod_oficio) !!}">Visualizar</a></td>
                    @endforeach
                  </tbody>
                </table>
              @else
                <p class="alert alert-info">Nenhum ofício foi enviado até o momento.</p>
              @endif
            </div>
          </div>

          <hr/>
          <div class="row">
            <div class="col-md-12">
              <div class="pull-right">
                @if($proposta->situacao != 'Cancelada')
                <a class="btn btn-primary" href="{!! action('PropostasController@edit', $obra->Proposta_cod_proposta) !!}" role="button"><span class="glyphicon glyphicon-pencil glyphicon-space"></span>Editar Proposta</a>
                <a href="{!! action('PropostasController@solicitarCancelamento', $obra->Proposta_cod_proposta) !!}" role="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-remove glyphicon-space"></span>Solicitar Cancelamento da Proposta</a>
                @else
                  <h5>Proposta CANCELADA!</h5>
                @endif

              </div>
            </div>
          </div>


          <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>

        </div> <!-- /quadro-->
      </div> <!-- /col -->
    </div> <!-- /row -->

    <!-- MODAL SOLICITAR CANCELAMENTO PROPOSTA -->
    <div class="modal fade" id="myModal2">
      <div class="modal-dialog"> <!-- modal-sm, modal-lg -->
        <div class="modal-content">
          <form class="" action="{!! action('PropostasController@solicitarCancelamento', $obra->Proposta_cod_proposta) !!}" method="post">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span arua-hidden="true">&times;</span></button>
                <h4 class="modal-title">Solicitar Cancelamento da Proposta</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="cad3">Conte-nos o motivo do cancelamento. <span style="color:red;">*</span> </label>
                  <textarea type="textarea" class="form-control" id="cad3" name="justificativa" placeholder="Obrigatório"></textarea>
                </div>
                <p>Esta ação enviará uma solicitação de cancelamento da Proposta para o Administrador do sistema. Uma vez solicidada, não poderá ser desfeita.</p>
                <p>Deseja continuar?</p>
              </div>
              <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button class="btn btn-primary" type="submit" >Enviar</button>
              </div>
            </form>
        </div> <!-- modal-content -->
      </div> <!-- modal-dialog -->
    </div>

    <!-- MODAL ENVIAR NOVA VERSÃO -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog"> <!-- modal-sm, modal-lg -->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span arua-hidden="true">&times;</span></button>
            <h4 class="modal-title">Enviar Nova Versão da Obra</h4>
          </div>
          <div class="modal-body">
            <form action="{!! route('enviarNovaVersao', $proposta->cod_proposta) !!}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <input type="hidden" name="cod_obra" value="{!! $obra->cod_obra !!}">
              <input type="hidden" name="cod_proposta" value="{!! $proposta->cod_proposta !!}">

              <div class="form-group">
                <label for="novo_documento_identificado">Documento COM identificação (.doc)</label>
                <input type="file" class="form-control" id="novo_documento_identificado" name="novo_documento_identificado">
              </div>
              <div class="form-group">
                <label for="novo_documento_nao_identificado">Documento SEM identificação (.doc)</label>
                <input type="file" class="form-control" id="novo_documento_nao_identificado" name="novo_documento_nao_identificado">
              </div>
              <div class="form-group">
                <label for="novas_imagens">Imagens (.zip ou .rar)</label>
                <input type="file" class="form-control" id="novas_imagens" name="novas_imagens">
              </div>
              <div class="form-group">
                <label for="oficio">Ofício de Alterações (.pdf)</label>
                <input type="file" class="form-control" id="oficio" name="oficio">
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
