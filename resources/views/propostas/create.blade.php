@extends('master')
@section('title', 'Enviar proposta')

@section('content')
<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <!-- SUBMISSÃO DE PROPOSTAS -->
        <div class="quadro">
          <!-- RETORNAR-->
            <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span>Voltar para Suas Propostas</a>

            <!-- TÍTULO -->
            <h3><span class="glyphicon glyphicon-cloud-upload glyphicon-space"></span><strong>Submissão de Proposta</strong></h3>

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
                <span class="glyphicon glyphicon-question-sign glyphicon-space" aria-hidden="true"></span>
                Preencha o formulário abaixo com os dados de sua obra. Os campos com asterisco (*) são obrigatórios.
              </div>
            @endif

            <!-- STATUS -->
            @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif

            <!-- FORMULÁRIO DE SUBMISSÃO-->
            <form method="post" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">

              <!-- DADOS DA OBRA -->
              <fieldset>
                <legend>Dados da Obra</legend>
                <div class="row">
                  <div class="form-group col-md-5 {{ $errors->has('titulo') ? 'has-error' :'' }}">
                    <label class="control-label" for="titulo">Título *</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="{{old('titulo')}}" maxlength="100">
                    @if ($errors->has('titulo'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('titulo') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-5 {{ $errors->has('subtitulo') ? 'has-error' :'' }}">
                    <label class="control-label" for="subtitulo">Subtítulo *</label>
                    <input type="text" class="form-control" id="subtitulo" name="subtitulo" placeholder="Subtítulo" value="{{old('subtitulo')}}" maxlength="100">
                    @if ($errors->has('subtitulo'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('subtitulo') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-2 {{ $errors->has('categoria_obra') ? 'has-error' :'' }}">
                    <label for="categoria_obra" class="control-label">Categoria *</label>
                    <select class="form-control" id="categoria_obra" name="categoria_obra">
                      <option value="">Selecione</option>
                      <option value="1" @if (old('categoria_obra') == 1) selected="selected" @endif>Livro</option>
                      <option value="2" @if (old('categoria_obra') == 2) selected="selected" @endif>Coletânea</option>
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
                    <textarea type="text" rows="8" class="form-control" id="resumo" name="resumo" placeholder="Resumo" value="{{old('resumo')}}" maxlength="2000">{{old('resumo')}}</textarea>
                    <p id="restantes_r" class="pull-right"></p>
                    @if ($errors->has('resumo'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('resumo') }}</strong></span>
                        </span>
                    @endif
                  </div>
                </div>

                <!-- TODO: Escrever ajuda sobre o que é a genese e relevancia -->
                <div class="row">
                  <div class="form-group col-md-12 {{ $errors->has('genese_relevancia') ? 'has-error' :'' }}">
                    <label class="control-label" for="genese_relevancia">Gênese e Relevância da proposta de publicação *</label>
                    <!-- AJUDA -->
                    <small><a href="javascript:;" data-toggle="popover" data-content="<a href='/ajuda#genese-relevancia' target='_blank'>Clique aqui</a> para saber mais sobre Gênese e Relevância. Este campo deve conter no máximo 5000 caracteres, contando com os espaços. Abaixo deste campo há um indicador de caracteres restantes." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                    <textarea type="text" rows="8" class="form-control" id="genese_relevancia" name="genese_relevancia" placeholder="Gênese e Relevância da sua proposta" value="{{old('genese_relevancia')}}" maxlength="5000">{{old('genese_relevancia')}}</textarea>
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
                    <input type="text" id="grande_area_obra" name="grande_area_obra" class="form-control" placeholder="Grande Área" value="{{old('grande_area_obra')}}" maxlength="100">
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
                    <input type="text" id="area_conhecimento_obra" name="area_conhecimento_obra" class="form-control" placeholder="Área de Conhecimento" value="{{old('area_conhecimento_obra')}}" maxlength="100">
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
                    <input type="text" id="subarea_obra" name="subarea_obra" class="form-control" placeholder="Subárea" value="{{old('subarea_obra')}}" maxlength="100">
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
                    <input type="text" id="especialidade_obra" name="especialidade_obra" class="form-control" placeholder="Especialidade" value="{{old('especialidade_obra')}}" maxlength="100">
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
                  <p><span class="glyphicon glyphicon-alert glyphicon-space"></span><strong>Atenção!</strong> Suas próprias informações podem ser alteradas apenas na guia <strong>Perfil</strong> localizada na barra superior da página. Somente o campo <strong>Categoria</strong> deve ser inserido nesta página.</p>
                </div>
                <div class="row">
                  <div class="form-group col-md-2 {{ $errors->has('categoria') ? 'has-error' :'' }}">
                    <label class="control-label" for="categoria">Categoria *</label>
                    <select class="form-control" name="categoria" id="categoria">
                      <option value="">Selecione</option>
                      <option value="1" @if (old('categoria') == 1) selected="selected" @endif>Autor</option>
                      <option value="2" @if (old('categoria') == 2) selected="selected" @endif>Co-Autor</option>
                      <option value="3" @if (old('categoria') == 3) selected="selected" @endif>Organizador</option>
                    </select>
                    @if ($errors->has('categoria'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('categoria') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-4 {{ $errors->has('nome') ? 'has-error' :'' }}">
                    <label class="control-label" for="nome">Nome *</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="{!! $autor->nome !!}" maxlength="50" disabled>
                    @if ($errors->has('nome'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('nome') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-4 {{ $errors->has('sobrenome') ? 'has-error' :'' }}">
                    <label class="control-label" for="sobrenome">Sobrenome *</label>
                    <input type="text" id="sobrenome" name="sobrenome" class="form-control" placeholder="Sobrenome" value="{!! $autor->sobrenome !!}" maxlength="100" disabled>
                    @if ($errors->has('sobrenome'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('sobrenome') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-2 {{ $errors->has('sexo') ? 'has-error' :'' }}">
                    <label for="sexo" class="control-label">Sexo *</label>
                    <select class="form-control" id="sexo" name="sexo" disabled>
                      <option value="">Selecione</option>
                      <option value="F" @if ($autor->sexo == 'F') selected="selected" @endif>F</option>
                      <option value="M" @if ($autor->sexo == 'M') selected="selected" @endif>M</option>
                    </select>
                    @if ($errors->has('sexo'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('sexo') }}</strong></span>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-4 {{ $errors->has('cpf') ? 'has-error' :'' }}">
                    <label class="control-label" for="cpf">CPF * </label>
                    <!-- AJUDA -->
                    <small><a href="javascript:;" data-toggle="popover" data-content="O campo CPF deve conter apenas números. Não é permitida a inserção de pontos ou traços." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                    <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF (somente números)" value="{!! $autor->cpf !!}" maxlength="11" disabled>
                    @if ($errors->has('cpf'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('cpf') }}</strong></span>
                        </span>
                    @endif
                  </div>


                  <div class="form-group col-md-4 {{ $errors->has('rg') ? 'has-error' :'' }}">
                    <label class="control-label" for="rg">RG *</label>
                    <!-- AJUDA -->
                    <small><a href="javascript:;" data-toggle="popover" data-content="O campo RG deve conter apenas números. Não é permitida a inserção de pontos ou traços." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                    <input type="text" id="rg" name="rg" class="form-control" placeholder="RG (somente números)" value="{!! $autor->rg !!}" maxlength="14" disabled>
                    @if ($errors->has('rg'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('rg') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-4 {{ $errors->has('estado_civil') ? 'has-error' :'' }}">
                    <label class="control-label" for="estado_civil">Estado Civil *</label>
                    <select class="form-control" id="estado_civil" name="estado_civil" disabled>
                      <option value="">Selecione</option>
                      <option value="Solteiro" @if ($autor->estado_civil  == 'Solteiro') selected="selected" @endif>Solteiro(a)</option>
                      <option value="Casado" @if ($autor->estado_civil == 'Casado') selected="selected" @endif>Casado(a)</option>
                      <option value="Separado" @if ($autor->estado_civil == 'Separado') selected="selected" @endif>Separado(a)</option>
                      <option value="Divorciado" @if ($autor->estado_civil == 'Divorciado') selected="selected" @endif>Divorciado(a)</option>
                      <option value="Viúvo" @if ($autor->estado_civil == 'Viúvo') selected="selected" @endif>Viúvo(a)</option>
                      <option value="Amasiado" @if ($autor->estado_civil == 'Amasiado') selected="selected" @endif>Amasiado(a)</option>
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
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{old('email')}}" maxlength="100"disabled>
                    @if ($errors->has('email'))
                    <span class="help-block">
                      <span class="text-danger"><strong>{{ $errors->first('email') }}</strong></span>
                    </span>
                    @endif
                  </div>

                  <div class="form-group col-md-3 {{ $errors->has('telefone') ? 'has-error' :'' }}">
                    <label class="control-label" for="telefone">Telefone *</label>
                    <!-- AJUDA-->
                    <small><a href="javascript:;" data-toggle="popover" data-content="O Telefone deve conter apenas números. Não é permitida a inserção de parênteses ou traços. Informe o deu DDD." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="{{old('telefone')}}" maxlength="14" disabled>
                    @if ($errors->has('telefone'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('telefone') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-3 {{ $errors->has('telefone_secundario') ? 'has-error' :'' }}">
                    <label class="control-label" for="telefone_secundario">Telefone secundário</label>
                    <!-- AJUDA-->
                    <small><a href="javascript:;" data-toggle="popover" data-content="O Telefone Secundário deve conter apenas números. Não é permitida a inserção de parênteses ou traços. Informe o deu DDD. Este campo é opcional." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                    <input type="text" class="form-control" id="telefone_secundario" name="telefone_secundario" placeholder="Telefone secundário" value="{{old('telefone_secundario')}}" maxlength="14" disabled>
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
                    <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Instituição a qual o Autor está vinculado." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                    <input type="text" class="form-control" id="instituicao" name="instituicao" placeholder="Instituição" value="{{old('instituicao')}}" maxlength="100" disabled>
                    @if ($errors->has('instituicao'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('instituicao') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-2 {{ $errors->has('sigla') ? 'has-error' :'' }}">
                    <label for="sigla" class="control-label">Sigla</label>
                    <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Sigla" value="{{old('sigla')}}" maxlength="20" disabled>
                    @if ($errors->has('sigla'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('sigla') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-5 {{ $errors->has('vinculo') ? 'has-error' :'' }}">
                    <label class="control-label" for="setor">Vínculo Institucional</label>
                    <!-- AJUDA -->
                    <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com o Setor ou Departamento aos quais o Autor está vinculado (opcional)." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                    <input type="text" class="form-control" id="vinculo" name="vinculo" placeholder="Setor, Departamento, ..." value="{{old('vinculo')}}" maxlength="200" disabled>
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

                    <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Grande Área do Autor conforme a tabela do CNPQ." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                    <input type="text" class="form-control" id="grande_area_autor" name="grande_area_autor" placeholder="Grande Área" value="{{old('grande_area_autor')}}" maxlength="100">
                    @if ($errors->has('grande_area_autor'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('grande_area_autor') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-6 {{ $errors->has('area_conhecimento_autor') ? 'has-error' :'' }}">
                    <label class="control-label" for="area_conhecimento_autor">Área de Conhecimento do Autor *</label>

                    <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Área de Conhecimento do Autor conforme a tabela do CNPQ." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                    <input type="text" class="form-control" id="area_conhecimento_autor" name="area_conhecimento_autor" placeholder="Área de Conhecimento" value="{{old('area_conhecimento_autor')}}" maxlength="100">
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

                    <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Subarea do Autor conforme a tabela do CNPQ (opcional)." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                    <input type="text" class="form-control" id="subarea_autor" name="subarea_autor" placeholder="Subarea" value="{{old('subarea_autor')}}" maxlength="100">
                    @if ($errors->has('subarea_autor'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('subarea_autor') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-6 {{ $errors->has('especialidade_autor') ? 'has-error' :'' }}">
                    <label class="control-label" for="especialidade_autor">Especialidade do Autor</label>
                      <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Especialidade do Autor conforme a tabela do CNPQ (opcional)." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                    <input type="text" class="form-control" id="especialidade_autor" name="especialidade_autor" placeholder="Especialidade" value="{{old('especialidade_autor')}}" maxlength="100">
                    @if ($errors->has('especialidade_autor'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('especialidade_autor') }}</strong></span>
                        </span>
                    @endif
                  </div>
                </div>
-->
                <!-- TODO: VERIFICAR A POSSIBILIDADE DE ADICIONAR MAIS AUTORES
                <div class="row">
                  <div class="col-md-12">
                    <button type="button" name="button" class="btn btn-success"><span class="glyphicon glyphicon-plus glyphicon-space"></span>Adicionar Autor</button>
                  </div>
                </div> -->
              </fieldset>

              <!--ARQUIVOS-->
              <fieldset>
                <legend>Arquivos</legend>

                <div class="form-group col-md-4 {{ $errors->has('documento_s_identificacao') | !$errors->isEmpty() ? 'has-error' :'' }}">
                  <label class="control-label" for="documento_s_identificacao">Documento sem Identificação *<br/>(.doc, .docx ou .odt)</label>
                  <input type="file" id="documento_s_identificacao" name="documento_s_identificacao" class="form-control">
                  @if ($errors->has('documento_s_identificacao'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('documento_s_identificacao') }}</strong></span>
                      </span>
                  @endif

                </div>

                <div class="form-group col-md-4 {{ $errors->has('documento_c_identificacao') | !$errors->isEmpty() ? 'has-error' :'' }}">
                  <label class="control-label" for="documento_c_identificacao">Documento com Identificação *<br/>(.doc, .docx ou .odt)</label>
                  <input type="file" id="documento_c_identificacao" name="documento_c_identificacao" class="form-control">
                  @if ($errors->has('documento_c_identificacao'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('documento_c_identificacao') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-4 {{ $errors->has('imagens') | !$errors->isEmpty() ? 'has-error' :'' }}">
                  <label class="control-label" for="imagens">Imagens *<br/>(.rar ou .zip)</label>
                  <input type="file" id="imagens" name="imagens" class="form-control">
                  @if ($errors->has('imagens'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('imagens') }}</strong></span>
                      </span>
                  @endif
                </div>
              </fieldset>

              <hr>
              <div class="row">
                <div class="col-md-4 col-md-offset-4">
                  <button type="submit" class="btn btn-primary btn-block">Submeter proposta</button>
                </div>
              </div>
            </form>

            <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span>Voltar para Suas Propostas</a>
        </div>
      </div> <!-- quadro -->
    </div>
  </div> <!--container -->
</div> <!-- content -->
@endsection
