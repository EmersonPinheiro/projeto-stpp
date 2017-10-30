@extends('master')
@section('title', 'Propostas')

@section('content')

@role('parecerista')
<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">

      <!-- PAINEL PRINCIPAL -->
      <div class="col-md-10 col-md-offset-1">
        <div class="quadro-painel painel-propostas">
          <div class="panel panel-default">
            <!-- CABEÇALHO PAINEL -->
            <div class="panel-heading">
              <span class="panel-title"><span class="glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;&nbsp;Lista de Propostas</span>
            </div>
            <div class="panel-body">
              <!-- LISTA DE PROPOSTAS -->
              <div class="painel-lista">
                <!-- List group -->
                <ul class="list-group">
                  @if($propostas->isEmpty())
                  <div class="alert alert-info" role="alert">
                    <p>Não há propostas a serem avaliadas.</p>
                  </div>
                  @else
                  @foreach($proposta as $propostas)
                  <li class="list-group-item titulo-lista">
                    <span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;Proposta 1
                    <div class="pull-right">
                      <a href="info-proposta-parecerista.html">Enviar Parecer</a> (Restam 5 dias!)
                    </div>
                  </li>
                  <li class="list-group-item">
                    <p><strong>Título da Obra: </strong>Obra Acadêmica</p>
                    <p><strong>Subtítulo da Obra: </strong>De um Professor Universitário</p>
                    <p><strong>Descrição: </strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus ex error explicabo tempore accusantium quae, ut asperiores quos deserunt, aliquid commodi qui sit sequi temporibus porro quibusdam. Minima, autem, magni.</p>
                    <p><strong>Documento (doc, docx): </strong>documento.doc<a href="">&nbsp;&nbsp;&nbsp;Baixar </a>| <a href="">Visualizar PDF</a></p>
                  </li>
                  @endforeach
                  @endif
                </ul>
              </div> <!-- painel-lista -->
              <!-- FIM LISTA DE PROPOSTAS -->
            </div> <!-- panel-body -->
          </div> <!-- panel -->
        </div> <!-- quadro-painel painel-propostas -->
      </div> <!-- col -->

    </div> <!-- row -->
  </div> <!--container -->
</div> <!-- content -->
@endrole
@endsection
