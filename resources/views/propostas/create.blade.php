@extends('master')
@section('title', 'Enviar proposta')

@section('content')
<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="quadro">
            <!-- CABEÇALHO PAINEL -->
            <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span> Voltar para Suas Propostas</a>

            <h3><span class="glyphicon glyphicon-cloud-upload glyphicon-space"></span>Submissão de Proposta</h3>

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

            <div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <span class="glyphicon glyphicon-info-sign glyphicon-space" aria-hidden="true"></span>
              Preencha o formulário abaixo com os dados de sua obra. Os campos com asterisco (*) são obrigatórios.
            </div>

            <!--FORMULÁRIO-->
            <form method="post" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <!--PROPOSTA-->
              <fieldset>
                <legend>Informações da Obra</legend>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="titulo">Título *</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="{{old('titulo')}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="subtitulo">Subtítulo *</label>
                    <input type="text" class="form-control" id="subtitulo" name="subtitulo" placeholder="Subtítulo" value="{{old('subtitulo')}}">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="descricao">Descrição *</label>
                    <textarea type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{old('descricao')}}"></textarea>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="grande_area_obra">Grande Área da Obra *</label>
                    <input type="text" id="grande_area_obra" name="grande_area_obra" class="form-control" placeholder="Grande Área" value="{{old('grande_area_obra')}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="area_conhecimento_obra">Área de Conhecimento da Obra *</label>
                    <input type="text" id="area_conhecimento_obra" name="area_conhecimento_obra" class="form-control" placeholder="Área de Conhecimento" value="{{old('area_conhecimento_obra')}}">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="subarea_obra">Subárea da Obra</label>
                    <input type="text" id="subarea_obra" name="subarea_obra" class="form-control" placeholder="Subárea" value="{{old('subarea_obra')}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="especialidade_obra">Especialidade da Obra</label>
                    <input type="text" id="especialidade_obra" name="especialidade_obra" class="form-control" placeholder="Especialidade" value="{{old('especialidade_obra')}}">
                  </div>
                </div>
              </fieldset>

              <!--AUTOR/PESSOA-->
              <fieldset>
                <legend>Informações de Autor</legend>
                <div class="row">
                  <div class="form-group col-md-2">
                    <label for="categoria">Categoria *</label>
                    <select class="form-control" name="categoria" id="categoria">
                      <option value="1">Autor</option>
                      <option value="2">Co-Autor</option>
                      <option value="3">Organizador</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="nome">Nome *</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="{!! $autor->nome !!}">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="sobrenome">Sobrenome *</label>
                    <input type="text" id="sobrenome" name="sobrenome" class="form-control" placeholder="Sobrenome" value="{!! $autor->sobrenome !!}">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="sexo">Sexo *</label><br/>
                    <!--VERIFICAR RECUPERAÇÃO DO VALOR ANTIGO EM CASO DE ERRO NO CADASTRO-->
                    <input type="radio" name="sexo" value="M"/> M&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="sexo" value="F"/> F
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="cpf">CPF *</label>
                    <input type="text" id="CPF" name="CPF" class="form-control" placeholder="CPF" value="{!! $autor->cpf !!}">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="rg">RG *</label>
                    <input type="text" id="rg" name="rg" class="form-control" placeholder="RG" value="{!! $autor->rg !!}">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="estado_civil">Estado Civil *</label>
                    <select name="estado_civil" class="form-control" id="estado_civil">
                        <option value="Solteiro">Solteiro(a)</option>
                        <option value="Casado">Casado(a)</option>
                        <option value="Separado">Separado(a)</option>
                        <option value="Divorciado">Divorciado(a)</option>
                        <option value="Viúvo">Viúvo(a)</option>
                        <option value="Amasiado">Amasiado(a)</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="email">E-mail *</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" value="{{old('email')}}">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="telefone">Telefone *</label>
                    <input type="text" id="telefone" name="telefone" class="form-control" placeholder="Telefone" value="{{old('telefone')}}">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="telefone_secundario">Telefone secundário</label>
                    <input type="text" id="telefone_secundario" name="telefone_sencundario" class="form-control" placeholder="Telefone secundário" value="{{old('telefone_secundario')}}">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                    <label for="instituicao">Instituição *</label>
                    <input type="text" id="instituicao" name="instituicao" class="form-control" placeholder="Instituição" value="{{old('instituicao')}}">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="setor">Setor</label>
                    <input type="text" id="setor" name="setor" class="form-control" placeholder="Setor" value="{{old('setor')}}">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="departamento">Departamento</label>
                    <input type="text" id="departamento" name="departamento" class="form-control" placeholder="Departamento" value="{{old('departamento')}}">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="grande_area_autor">Grande Área do Autor *</label>
                    <input type="text" id="grande_area_autor" name="grande_area_autor" class="form-control" placeholder="Grande Área" value="{{old('grande_area_autor')}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="area_conhecimento_autor">Área de Conhecimento do Autor *</label>
                    <input type="text" id="area_conhecimento_autor" name="area_conhecimento_autor" class="form-control" placeholder="Área de Conhecimento" value="{{old('area_conhecimento_autor')}}">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="subarea_autor">Subárea do Autor</label>
                    <input type="text" id="subarea_autor" name="subarea_autor" class="form-control" placeholder="Subárea" value="{{old('subarea_autor')}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="especialidade_autor">Especialidade do Autor</label>
                    <input type="text" id="especialidade_autor" name="especialidade_autor" class="form-control" placeholder="Especialidade" value="{{old('especialidade_autor')}}">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <button type="button" name="button" class="btn btn-success"><span class="glyphicon glyphicon-plus glyphicon-space"></span>Adicionar Autor</button>
                  </div>
                </div>
              </fieldset>

              <!--ARQUIVOS-->
              <fieldset>
                <legend>Arquivos</legend>
                <div class="form-group col-md-4">
                  <label for="doc_s_identificacao">Documento sem Identificação *<br/>(.doc, .docx ou .odt)</label>
                  <input type="file" id="documento_s_identificacao" name="documento_s_identificacao" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label for="doc_c_identificacao">Documento com Identificação *<br/>(.doc, .docx ou .odt)</label>
                  <input type="file" id="documento_c_identificacao" name="documento_c_identificacao" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label for="imagens">Imagens *<br/>(.rar ou .zip)</label>
                  <input type="file" id="imagens" name="imagens" class="form-control">
                </div>
              </fieldset>
              <hr>
              <div class="row">
                <div class="col-md-4 col-md-offset-4">
                  <button type="submit" class="btn btn-primary btn-block">Submeter proposta</button>
                </div>
              </div>
            </form>
            <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>
        </div>
      </div> <!-- quadro -->
    </div>
  </div> <!--container -->
</div> <!-- content -->
@endsection
