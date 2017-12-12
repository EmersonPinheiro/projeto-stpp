@extends('master')
@section('title', 'Editar proposta')

@section('content')
<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="quadro">
          <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>

          <!-- TÍTULO -->
          <h3><span class="glyphicon glyphicon-pencil glyphicon-space"></span><strong>Editar Proposta</strong></h3>

          @if (!$errors->isEmpty())
            <!-- ERRO -->
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <p><span class="glyphicon glyphicon-exclamation-sign glyphicon-space"></span>
              <strong>Ops! Algo deu errado.</strong> Preencha corretamente o formulário abaixo com os dados de sua obra. Os campos com asterisco (*) são obrigatórios.</p>
            </div>
          @else
            <!-- INFORMAÇÕES-->
            <div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <span class="glyphicon glyphicon-info-sign glyphicon-space" aria-hidden="true"></span>
              Preencha o formulário abaixo com os dados de sua obra. Os campos com asterisco (*) são obrigatórios.
            </div>
          @endif

          <!-- STATUS -->
          @if (session('status'))
          <div class="alert alert-info">
            {{ session('status') }}
          </div>
          @endif

          <!-- FORMULÁRIO DE ALTERAÇÃO -->
          <form method="post">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <input type="hidden" name="cod_grande_area" value="{!! $obra->grande_area_obra !!}">
            <input type="hidden" name="cod_area_conhec" value="{!! $obra->area_conhecimento_obra !!}">
            <input type="hidden" name="cod_subarea" value="{!! $obra->subarea_obra !!}">
            <input type="hidden" name="cod_especialidade" value="{!! $obra->especialidade_obra !!}">

            <!-- DADOS DA OBRA -->
            <fieldset>
              <legend>Dados da Obra</legend>
              <div class="row">
                <div class="form-group col-md-5 {{ $errors->has('titulo') ? 'has-error' :'' }}">
                  <label class="control-label" for="titulo">Título *</label>
                  <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="{{ !$errors->isEmpty() ? old('titulo') : $obra->titulo }}" maxlength="100">
                  @if ($errors->has('titulo'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('titulo') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-5 {{ $errors->has('subtitulo') ? 'has-error' :'' }}">
                  <label class="control-label" for="subtitulo">Subtítulo *</label>
                  <input type="text" class="form-control" id="subtitulo" name="subtitulo" placeholder="Subtítulo" value="{{ !$errors->isEmpty() ? old('subtitulo') : $obra->subtitulo }}" maxlength="100">
                  @if ($errors->has('subtitulo'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('subtitulo') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-2 {{ $errors->has('categoria_obra') ? 'has-error' :'' }}">
                  <label for="categoria_obra" class="control-label">Categoria *</label>
                  <?php !$errors->isEmpty() ? $categoria_obra_aux=old('categoria_obra') : $categoria_obra_aux=$obra->categoria ?>
                  <select class="form-control" id="categoria_obra" name="categoria_obra">
                    <option value="">Selecione</option>
                    <option value="1" @if ($categoria_obra_aux == 1) selected="selected" @endif>Livro</option>
                    <option value="2" @if ($categoria_obra_aux == 2) selected="selected" @endif>Coletânea</option>
                  </select>
                  @if ($errors->has('categoria_obra'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('categoria_obra') }}</strong></span>
                      </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-12 {{ $errors->has('resumo') ? 'has-error' :'' }}">
                  <label class="control-label" for="resumo">Resumo *</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="O Resumo deve conter no máximo 2000 caracteres, contando com os espaços. Abaixo deste campo há um indicador de caracteres restantes." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <textarea type="text" class="form-control" id="resumo" name="resumo" placeholder="Resumo" rows="8">{{ !$errors->isEmpty() ? old('resumo') : $obra->resumo }}</textarea>
                  <p id="restantes_r" class="pull-right"></p>
                  @if ($errors->has('resumo'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('resumo') }}</strong></span>
                      </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-12 {{ $errors->has('genese_relevancia') ? 'has-error' :'' }}">
                  <label class="control-label" for="genese_relevancia">Gênese e Relevância da proposta de publicação *</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="<a href='/ajuda#genese-relevancia' target='_blank'>Clique aqui</a> para saber mais sobre Gênese e Relevância. Este campo deve conter no máximo 5000 caracteres, contando com os espaços. Abaixo deste campo há um indicador de caracteres restantes." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <textarea type="text" class="form-control" id="genese_relevancia" name="genese_relevancia" placeholder="Gênese e Relevancia" rows="8">{{ !$errors->isEmpty() ? old('genese_relevancia') : $obra->genese_relevancia }}</textarea>
                  <p id="restantes_gr" class="pull-right"></p>
                  @if ($errors->has('genese_relevancia'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('genese_relevancia') }}</strong></span>
                      </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6 {{ $errors->has('grande_area_obra') ? 'has-error' :'' }}">
                  <label class="control-label" for="grande_area_obra">Grande Área da Obra *</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Grande Área da obra <a href='http://www.cnpq.br/documents/10157/186158/TabeladeAreasdoConhecimento.pdf' target='_blank'>conforme a tabela do CNPQ</a>." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="text" id="grande_area_obra" name="grande_area_obra" class="form-control" placeholder="Grande Área" value="{{ !$errors->isEmpty() ? old('grande_area_obra') : $obra->grande_area_obra }}" maxlength="100">
                  @if ($errors->has('grande_area_obra'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('grande_area_obra') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-6 {{ $errors->has('area_conhecimento_obra') ? 'has-error' :'' }}">
                  <label class="control-label" for="area_conhecimento_obra">Área de Conhecimento da Obra *</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Área de Conhecimento da obra <a href='http://www.cnpq.br/documents/10157/186158/TabeladeAreasdoConhecimento.pdf' target='_blank'>conforme a tabela do CNPQ</a>." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="text" id="area_conhecimento_obra" name="area_conhecimento_obra" class="form-control" placeholder="Área de Conhecimento" value="{{ !$errors->isEmpty() ? old('area_conhecimento_obra') : $obra->area_conhecimento_obra }}" maxlength="100">
                  @if ($errors->has('area_conhecimento_obra'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('area_conhecimento_obra') }}</strong></span>
                      </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6 {{ $errors->has('subarea_obra') ? 'has-error' :'' }}">
                  <label class="control-label" for="subarea_obra">Subárea da Obra</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Subarea da obra <a href='http://www.cnpq.br/documents/10157/186158/TabeladeAreasdoConhecimento.pdf' target='_blank'>conforme a tabela do CNPQ</a>." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="text" id="subarea_obra" name="subarea_obra" class="form-control" placeholder="Subárea" value="{{ !$errors->isEmpty() ? old('subarea_obra') : $obra->subarea_obra }}" maxlength="100">
                  @if ($errors->has('subarea_obra'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('subarea_obra') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-6 {{ $errors->has('especialidade_obra') ? 'has-error' :'' }}">
                  <label class="control-label" for="especialidade_obra">Especialidade da Obra</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Especialidade da obra <a href='http://www.cnpq.br/documents/10157/186158/TabeladeAreasdoConhecimento.pdf' target='_blank'>conforme a tabela do CNPQ</a>." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="text" id="especialidade_obra" name="especialidade_obra" class="form-control" placeholder="Especialidade" value="{{ !$errors->isEmpty() ? old('especialidade_obra') : $obra->especialidade_obra }}" maxlength="100">
                  @if ($errors->has('especialidade_obra'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('especialidade_obra') }}</strong></span>
                      </span>
                  @endif
                </div>
              </div>
            </fieldset>

            <!--AUTOR/PESSOA-->
            <fieldset>
              <legend>Dados do(s) Autor(es)</legend>
              <div class="alert alert-warning">
                <p><span class="glyphicon glyphicon-alert glyphicon-space"></span>Atenção! Suas próprias informações podem ser alteradas apenas na guia Perfil localizada na barra superior da página. Somente o campo Categoria pode ser editado nesta página.</p>
              </div>
              <!-- TODO: verificar inclusão de amis autores
              <table class="table table-striped">
                @foreach($autores as $autor)
                <thead>
                  <tr>
                    <th>Nº</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Categoria</th>
                    <th>Ação</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>{!! $autor->nome !!}</td>
                    <td>{!! $autor->sobrenome !!}</td>
                    <td>@if($autor->categoria == 1)
                          Autor
                        @elseif($autor->categoria == 2)
                          Co-Autor
                        @elseif($autor->categoria == 3)
                          Organizador
                        @endif

                    </td>
                    <td><a href="javascript:;" id="btn-edita-autor" class="btn btn-primary btn-right-space"><span class="glyphicon glyphicon-pencil glyphicon-space"></span>Editar</a><a href="javascript:;" class="btn btn-danger"><span class="glyphicon glyphicon-remove glyphicon-space"></span>Excluir</a></td>
                  </tr>
                </tbody>
              </table> -->

              <!-- ADICIONAR CLASSE INVISIVEL -->
              <div id="info-autor" class="">
                <div class="row">
                  <div class="form-group col-md-2 {{ $errors->has('categoria') ? 'has-error' :'' }}">
                    <label class="control-label" for="categoria">Categoria *</label>
                    <?php !$errors->isEmpty() ? $categoria_aux=old('categoria') : $categoria_aux=$autor->categoria ?>
                    <select class="form-control" name="categoria" id="categoria">
                      <option value="">Selecione</option>
                      <option value="1" @if ($categoria_aux == 1) selected="selected" @endif>Autor</option>
                      <option value="2" @if ($categoria_aux == 2) selected="selected" @endif>Co-Autor</option>
                      <option value="3" @if ($categoria_aux == 3) selected="selected" @endif>Organizador</option>
                    </select>
                    @if ($errors->has('categoria'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('categoria') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-4 {{ $errors->has('nome') ? 'has-error' :'' }}">
                    <label class="control-label" for="nome">Nome *</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="{{ !$errors->isEmpty() ? old('nome') : $autor->nome }}" maxlength="50" disabled>
                    @if ($errors->has('nome'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('nome') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-4 {{ $errors->has('sobrenome') ? 'has-error' :'' }}">
                    <label class="control-label" for="sobrenome">Sobrenome *</label>
                    <input type="text" id="sobrenome" name="sobrenome" class="form-control" placeholder="Sobrenome" value="{{ !$errors->isEmpty() ? old('sobrenome') : $autor->sobrenome }}" maxlength="100" disabled>
                    @if ($errors->has('sobrenome'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('sobrenome') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-2 {{ $errors->has('sexo') ? 'has-error' :'' }}">
                    <label for="sexo" class="control-label">Sexo *</label>
                    <?php !$errors->isEmpty() ? $sexo_aux=old('sexo') : $sexo_aux=$autor->sexo ?>
                    <select class="form-control" id="sexo" name="sexo" disabled>
                      <option value="">Selecione</option>
                      <option value="F" @if ($sexo_aux == 'F') selected="selected" @endif>F</option>
                      <option value="M" @if ($sexo_aux == 'M') selected="selected" @endif>M</option>
                    </select>
                    @if ($errors->has('sexo'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('sexo') }}</strong></span>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-4 {{ $errors->has('cpf') ? 'has-error' :'' }}"draggable="">
                    <label class="control-label" for="cpf">CPF * </label>
                    <!-- AJUDA -->
                    <small><a href="javascript:;" data-toggle="popover" data-content="O campo CPF deve conter apenas números. Não é permitida a inserção de pontos ou traços." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                    <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF (somente números)" value="{{ !$errors->isEmpty() ? old('cpf') : $autor->cpf }}" maxlength="11" disabled>
                    @if ($errors->has('cpf'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('cpf') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-4 {{ $errors->has('rg') ? 'has-error' :'' }}">
                    <label class="control-label" for="rg">RG *</label>
                    <!-- AJUDA -->
                    <small><a href="javascript:;" data-toggle="popover" data-content="O campo RG deve conter apenas números. Não é permitida a inserção de pontos ou traços." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                    <input type="text" id="rg" name="rg" class="form-control" placeholder="RG (somente números)" value="{{ !$errors->isEmpty() ? old('rg') : $autor->rg }}" maxlength="14" disabled>
                    @if ($errors->has('rg'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('rg') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-4 {{ $errors->has('estado_civil') ? 'has-error' :'' }}">
                    <label class="control-label" for="estado_civil">Estado Civil *</label>
                    <?php !$errors->isEmpty() ? $estado_civil_aux=old('estado_civil') : $estado_civil_aux=$autor->estado_civil ?>
                    <select class="form-control" id="estado_civil" name="estado_civil" disabled>
                      <option value="">Selecione</option>
                      <option value="Solteiro" @if ($estado_civil_aux  == 'Solteiro') selected="selected" @endif>Solteiro(a)</option>
                      <option value="Casado" @if ($estado_civil_aux == 'Casado') selected="selected" @endif>Casado(a)</option>
                      <option value="Separado" @if ($estado_civil_aux == 'Separado') selected="selected" @endif>Separado(a)</option>
                      <option value="Divorciado" @if ($estado_civil_aux == 'Divorciado') selected="selected" @endif>Divorciado(a)</option>
                      <option value="Viúvo" @if ($estado_civil_aux == 'Viúvo') selected="selected" @endif>Viúvo(a)</option>
                      <option value="Amasiado" @if ($estado_civil_aux == 'Amasiado') selected="selected" @endif>Amasiado(a)</option>
                    </select>
                    @if ($errors->has('estado_civil'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('estado_civil') }}</strong></span>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-6 {{ $errors->has('email') ? 'has-error' :'' }}">
                    <label class="control-label" for="email_secundario">E-mail *</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="" maxlength="100" disabled>
                    @if ($errors->has('email'))
                    <span class="help-block">
                      <span class="text-danger"><strong>{{ $errors->first('email') }}</strong></span>
                    </span>
                    @endif
                  </div>

                  <div class="form-group col-md-3 {{ $errors->has('telefone') ? 'has-error' :'' }}">
                    <label class="control-label" for="telefone">Telefone *</label>
                    <!-- AJUDA-->
                    <small><a href="javascript:;" data-toggle="popover" data-content="O campo Telefone deve conter apenas números. Não é permitida a inserção de parênteses ou traços. Informe o deu DDD." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="" maxlength="14" disabled>
                    @if ($errors->has('telefone'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('telefone') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-3 {{ $errors->has('telefone_secundario') ? 'has-error' :'' }}">
                    <label class="control-label" for="telefone_secundario">Telefone secundário</label>
                    <!-- AJUDA-->
                    <small><a href="javascript:;" data-toggle="popover" data-content="O campo Telefone Secundário deve conter apenas números. Não é permitida a inserção de parênteses ou traços. Informe o deu DDD. Este campo é opcional." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                    <input type="text" class="form-control" id="telefone_secundario" name="telefone_secundario" placeholder="Telefone secundário" value="" maxlength="14" disabled>
                    @if ($errors->has('telefone_secundario'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('telefone_secundario') }}</strong></span>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-5 {{ $errors->has('instituicao') ? 'has-error' :'' }}">
                    <label class="control-label" for="instituicao">Instituição *</label>
                    <!-- AJUDA -->
                    <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Instituição a qual o Autor está vinculado." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                    <input type="text" class="form-control" id="instituicao" name="instituicao" placeholder="Instituição" value="{{ !$errors->isEmpty() ? old('instituicao') : $autor->nome_instituicao }}" maxlength="100" disabled>
                    @if ($errors->has('instituicao'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('instituicao') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-2 {{ $errors->has('sigla') ? 'has-error' :'' }}">
                    <label for="sigla" class="control-label">Sigla</label>
                    <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Sigla" value="{{ !$errors->isEmpty() ? old('sigla') : $autor->sigla }}" maxlength="20" disabled>
                    @if ($errors->has('sigla'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('sigla') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-5 {{ $errors->has('vinculo') ? 'has-error' :'' }}">
                    <label class="control-label" for="setor">Vínculo Institucional</label>
                    <!-- AJUDA -->
                    <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com o Setor ou Departamento aos quais o Autor está vinculado (opcional)." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                    <input type="text" class="form-control" id="vinculo" name="vinculo" placeholder="Setor, Departamento, ..." value="{{ !$errors->isEmpty() ? old('vinculo') : $autor->nome_vinculo }}" maxlength="200" disabled>
                    @if ($errors->has('vinculo'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('vinculo') }}</strong></span>
                        </span>
                    @endif
                  </div>
                </div>
<!--
                <div class="row">
                  <div class="form-group col-md-6 {{ $errors->has('grande_area_autor') ? 'has-error' :'' }}">
                    <label class="control-label" for="grande_area_autor">Grande Área do Autor *</label>

                    <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Grande Área do Autor definida pelo CNPQ." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                    <input type="text" class="form-control" id="grande_area_autor" name="grande_area_autor" placeholder="Grande Área" value="" maxlength="100">
                    @if ($errors->has('grande_area_autor'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('grande_area_autor') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-6 {{ $errors->has('area_conhecimento_autor') ? 'has-error' :'' }}">
                    <label class="control-label" for="area_conhecimento_autor">Área de Conhecimento do Autor *</label>

                    <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Área de Conhecimento do Autor definida pelo CNPQ." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                    <input type="text" class="form-control" id="area_conhecimento_autor" name="area_conhecimento_autor" placeholder="Área de Conhecimento" value="" maxlength="100">
                    @if ($errors->has('area_conhecimento_autor'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('area_conhecimento_autor') }}</strong></span>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 {{ $errors->has('subarea_autor') ? 'has-error' :'' }}">
                    <label class="control-label" for="subarea_autor">Subarea do Autor</label>

                    <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Subarea do Autor definida pelo CNPQ (opcional)." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                    <input type="text" class="form-control" id="subarea_autor" name="subarea_autor" placeholder="Subarea" value="" maxlength="100">
                    @if ($errors->has('subarea_autor'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('subarea_autor') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-6 {{ $errors->has('especialidade_autor') ? 'has-error' :'' }}">
                    <label class="control-label" for="especialidade_autor">Especialidade do Autor</label>

                    <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Especialidade do Autor definida pelo CNPQ (opcional)." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                    <input type="text" class="form-control" id="especialidade_autor" name="especialidade_autor" placeholder="Especialidade" value="" maxlength="100">
                    @if ($errors->has('especialidade_autor'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('especialidade_autor') }}</strong></span>
                        </span>
                    @endif
                  </div>
-
                </div>
              </div>
-->
              <!-- TODO: verificar inserção de mais autores
              <div class="row">
                <div class="col-md-12">
                  <button type="button" name="button" class="btn btn-success"><span class="glyphicon glyphicon-plus glyphicon-space"></span>Adicionar Autor</button>
                </div>
              </div>
              @endforeach -->
            </fieldset>
            <hr>
            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-block">Submeter alterações</button>
              </div>
            </div>
          </div>
        </form>

        </div> <!-- quadro -->
      </div>
    </div>
  </div> <!--container -->
</div> <!-- content -->
@endsection
