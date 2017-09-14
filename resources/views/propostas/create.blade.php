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
              <span class="panel-title"><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;&nbsp;&nbsp;Submissão de Proposta</span>
            </div>

            <div class="panel-body text-justify">
              <a href="/painel"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel</a>
              <!--FORMULÁRIO-->
              <form method="post" enctype="multipart/form-data">

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <!--PROPOSTA-->
                <h3 class="titulo col-md-12">Informações da Obra</h3>
                <div class="form-group col-md-6">
                  <label>Título</label>
                  <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
                </div>
                <div class="form-group col-md-6">
                  <label>Subtítulo</label>
                  <input type="text" class="form-control" id="subtitulo" name="subtitulo" placeholder="Subtítulo">
                </div>
                <div class="form-group col-md-12">
                  <label>Descrição</label>
                  <textarea type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição"></textarea>
                </div>
                <div class="form-group col-md-12">
                  <label>Resumo</label>
                  <textarea type="text" class="form-control" id="resumo" name="resumo" placeholder="Resumo"></textarea>
                </div>
                <div class="form-group col-md-12">
                  <label>Palavras-chave</label>
                  <textarea type="text" class="form-control" id="palavra" name="palavra" placeholder="Resumo"></textarea>
                </div>


                <!--AUTOR/PESSOA-->
                <h3 class="titulo col-md-12">Autor</h3>
                <h4 class="col-md-12">Informações Pessoais</h4>
                <div class="form-group col-md-4">
                  <label>Nome</label>
                  <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome">
                </div>
                <div class="form-group col-md-8">
                  <label>Sobrenome</label>
                  <input type="text" id="sobrenome" name="sobrenome" class="form-control" placeholder="Sobrenome">
                </div>
                <div class="form-group col-md-6">
                  <label>CPF</label>
                  <input type="text" id="CPF" name="CPF" class="form-control" placeholder="CPF">
                </div>
                <div class="form-group col-md-6">
                  <label>Sexo</label><br/>
                  <input type="radio" name="sexo" value="M"/> M&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="sexo" value="F"/> F
                </div>

                <!--INSTITUIÇÃO/DEPARTAMENTO/SETOR...-->
                <h4 class="col-md-12">Informações Profissionais</h4>
                <div class="form-group col-md-4">
                  <label>Instituição</label>
                  <input type="text" id="instituicao" name="instituicao" class="form-control" placeholder="Instituição">
                </div>
                <div class="form-group col-md-4">
                  <label>Setor</label>
                  <input type="text" id="setor" name="setor" class="form-control" placeholder="Setor">
                </div>
                <div class="form-group col-md-4">
                  <label>Departamento</label>
                  <input type="text" id="departamento" name="departamento" class="form-control" placeholder="Departamento">
                </div>
                <div class="form-group col-md-3">
                  <label>Grande Área</label>
                  <input type="text" id="grande_area" name="grande_area" class="form-control" placeholder="Grande Área">
                </div>
                <div class="form-group col-md-3">
                  <label>Área de Conhecimento</label>
                  <input type="text" id="area_de_conhecimento" name="area_de_conhecimento" class="form-control" placeholder="Área de Conhecimento">
                </div>
                <div class="form-group col-md-3">
                  <label>Subárea</label>
                  <input type="text" id="subarea" name="subarea" class="form-control" placeholder="Subárea">
                </div>
                <div class="form-group col-md-3">
                  <label>Especialidade</label>
                  <input type="text" id="especialidade" name="especialidade" class="form-control" placeholder="Especialidade">
                </div>

                <!--CONTATO-->
                <h4 class="col-md-12">Informações de Contato</h4>
                <div class="form-group col-md-6">
                  <label>E-mail</label>
                  <input type="text" id="email" name="email" class="form-control" placeholder="E-mail">
                </div>
                <div class="form-group col-md-6">
                  <label>Telefone</label>
                  <input type="text" id="telefone" name="telefone" class="form-control" placeholder="Telefone">
                </div>

                <!--LOCALIDADE-->
                <div class="form-group col-md-4">
                  <label>Cidade</label>
                  <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade">
                </div>
                <div class="form-group col-md-4">
                  <label>Estado</label>
                  <input type="text" id="estado" name="estado" class="form-control" placeholder="Estado">
                </div>
                <div class="form-group col-md-4">
                  <label>País</label>
                  <input type="text" id="pais" name="pais" class="form-control" placeholder="País">
                </div>

                <!--ARQUIVOS-->
                <h3 class="titulo col-md-12">Arquivos</h3>
                <div class="form-group col-md-6">
                  <label>Documento (.doc ou .docx)</label>
                  <input type="file" id="documento" name="documento" class="form-control">
                </div>
                <div class="form-group col-md-6">
                  <label for="cad7">Imagens (.rar)</label>
                  <input type="file" id="imagens" name="imagens" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submeter</button>
              </form>
            </div>
            <div class="panel-footer">
              <a href="/painel"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel</a>
            </div>
          </div> <!-- painel -->
        </div> <!-- /quadro-painel /painel-info-propostas -->
      </div>
    </div>
  </div> <!--container -->
</div> <!-- content -->
@endsection
