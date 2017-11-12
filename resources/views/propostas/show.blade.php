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
          <h3><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;{{$obra->titulo}}</h3>

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
          <p class="text-warning"><strong>Situação: </strong>{!! $proposta->situacao !!}</p>
          <p><strong>Título da Obra: </strong>{!! $obra->titulo !!}</p>
          <p><strong>Subtítulo da Obra: </strong>{!! $obra->subtitulo !!}</p>
          <p><strong>Autor(es):
          @foreach($autores as $autor)
            </strong>{!! $autor->nome !!} {!! $autor->sobrenome !!}</p>
          @endforeach
          <p><strong>Descrição: </strong>{!! $obra->descricao !!}</p>
          <button type="button" name="button" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-down glyphicon-space"></span> Informações Adicionais</button>
          
          <h4 class="titulo">Arquivos</h4>
          @foreach($materiais as $material)
          <p><i>Versão {!! $material->versao !!}</i></p>
          <p><strong>Documento (doc, docx): </strong>documento.doc<a href="{!! action('MaterialController@downloadMaterial', $material->cod_material) !!}">&nbsp;&nbsp;&nbsp;Baixar </a></p>
          <p><strong>Imagens (zip, rar): </strong>imagens.zip<a href="">&nbsp;&nbsp;&nbsp;Baixar </a></p>
          @endforeach

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-cloud-upload glyphicon-space"></span>Enviar nova nersão da Obra</button>
          <hr/>
          <div class="row">
            <div class="col-md-12">
              <div class="pull-right">
                <a class="btn btn-primary" href="{!! action('PropostasController@edit', $obra->Proposta_cod_proposta) !!}" role="button"><span class="glyphicon glyphicon-pencil glyphicon-space"></span>Editar Proposta</a>
                <a href="" role="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-remove glyphicon-space"></span>Solicitar Cancelamento da Proposta</a>
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

    <!-- MODAL ENVIAR NOVA VERSÃO -->
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
