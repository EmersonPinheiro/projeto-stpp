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
                Ops! Algo deu errado. Preencha corretamente o formulário abaixo com os dados de sua obra. Os campos com asterisco (*) são obrigatórios.</p>
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

              <!-- Dados obrigatórios que o autor não insere -->
              <input type="hidden" name="nome" value="{!! $autor->nome !!}">
              <input type="hidden" name="sobrenome" value="{!! $autor->sobrenome !!}">
              <input type="hidden" name="sexo" value="{!! $autor->sexo !!}">
              <input type="hidden" name="cpf" value="{!! $autor->cpf !!}">
              <input type="hidden" name="rg" value="{!! $autor->rg !!}">
              <input type="hidden" name="estado_civil" value="{!! $autor->estado_civil !!}">
              <input type="hidden" name="email" value="{!! $usuario->email !!}">
              <input type="hidden" name="telefone" value="{!! $telefone->numero !!}">
              <input type="hidden" name="instituicao" value="{!! $instituicaoVinculo->nome_instituicao !!}">
              <input type="hidden" name="sigla" value="{!! $instituicaoVinculo->sigla !!}">
              <input type="hidden" name="vinculo" value="{!! $instituicaoVinculo->nome_vinculo !!}">


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
                    <label class="control-label" for="subtitulo">Subtítulo</label>
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
                    <label class="control-label" for="genese_relevancia">Gênese e Relevância da Obra *</label>
                    <!-- AJUDA -->
                    <small><a href="javascript:;" data-toggle="popover" data-content="<a href='/ajuda#genese-relevancia' target='_blank'>Clique aqui</a> para saber mais sobre Gênese e Relevância. Este campo deve conter no máximo 5000 caracteres, contando com os espaços. Abaixo deste campo há um indicador de caracteres restantes." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                    <textarea type="text" rows="8" class="form-control" id="genese_relevancia" name="genese_relevancia" placeholder="Gênese e Relevância da Obra" value="{{old('genese_relevancia')}}" maxlength="5000">{{old('genese_relevancia')}}</textarea>
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
                  <p><span class="glyphicon glyphicon-alert glyphicon-space"></span><strong>Atenção!</strong> Suas próprias informações podem ser alteradas apenas na guia <strong>Perfil</strong> localizada na barra superior da página. Somente o campo <strong>Categoria</strong> deve ser a seguir.</p>
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
                    <label class="control-label" for="">Nome *</label>
                    <input type="text" id="nome" name="" class="form-control" placeholder="Nome" value="{!! $autor->nome !!}" maxlength="50" disabled>
                    @if ($errors->has('nome'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('nome') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-4 {{ $errors->has('sobrenome') ? 'has-error' :'' }}">
                    <label class="control-label" for="">Sobrenome *</label>
                    <input type="text" id="sobrenome" name="" class="form-control" placeholder="Sobrenome" value="{!! $autor->sobrenome !!}" maxlength="100" disabled>
                    @if ($errors->has('sobrenome'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('sobrenome') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-2 {{ $errors->has('sexo') ? 'has-error' :'' }}">
                    <label for="" class="control-label">Sexo *</label>
                    <select class="form-control" id="sexo" name="" disabled>
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
                    <input type="text" id="cpf" name="" class="form-control" placeholder="CPF (somente números)" value="{!! $autor->cpf !!}" maxlength="11" disabled>
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
                    <input type="text" id="rg" name="" class="form-control" placeholder="RG (somente números)" value="{!! $autor->rg !!}" maxlength="14" disabled>
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
                  <div class="form-group col-md-7 {{ $errors->has('email') ? 'has-error' :'' }}">
                    <label class="control-label" for="email_secundario">E-mail *</label>
                    <input type="email" class="form-control" id="email" name="" placeholder="E-mail" value="{!! $usuario->email !!}" maxlength="100" disabled>
                    @if ($errors->has('email'))
                    <span class="help-block">
                      <span class="text-danger"><strong>{{ $errors->first('email') }}</strong></span>
                    </span>
                    @endif
                  </div>

                  <div class="form-group col-md-5 {{ $errors->has('telefone') ? 'has-error' :'' }}">
                    <label class="control-label" for="telefone">Telefone *</label>
                    <!-- AJUDA-->
                    <small><a href="javascript:;" data-toggle="popover" data-content="O Telefone deve conter apenas números. Não é permitida a inserção de parênteses ou traços. Informe o deu DDD." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                    <input type="text" class="form-control" id="telefone" name="" placeholder="Telefone" value="{!! $telefone->numero !!}" maxlength="14" disabled>
                    @if ($errors->has('telefone'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('telefone') }}</strong></span>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-5 {{ $errors->has('instituicao') ? 'has-error' :'' }}">
                    <label class="control-label" for="instituicao">Instituição *</label>
                    <!-- AJUDA -->
                    <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Instituição a qual o Autor está vinculado." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                    <input type="text" class="form-control" id="instituicao" name="" placeholder="Instituição" value="{!! $instituicaoVinculo->nome_instituicao !!}" maxlength="100" disabled>
                    @if ($errors->has('instituicao'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('instituicao') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-2 {{ $errors->has('sigla') ? 'has-error' :'' }}">
                    <label for="sigla" class="control-label">Sigla</label>
                    <input type="text" class="form-control" id="sigla" name="" placeholder="Sigla" value="{!! $instituicaoVinculo->sigla !!}" maxlength="20" disabled>
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
                    <input type="text" class="form-control" id="vinculo" name="" placeholder="Setor, Departamento, ..." value="{!! $instituicaoVinculo->nome_vinculo !!}" maxlength="200" disabled>
                    @if ($errors->has('vinculo'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('vinculo') }}</strong></span>
                        </span>
                    @endif
                  </div>
                </div>

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
                <div class="row">
                  <div class="col-md-12 checkbox {{ $errors->has('termos') | !$errors->isEmpty() ? 'has-error' :'' }}">
                    <label for="termos">
                      <input type="checkbox" name="termos" id="termos"> * Li e concordo com os <a href="/termos-de-uso" target="_blank" >Termos de Uso</a> do sistema.
                    </label>
                    @if ($errors->has('termos'))
                    <span class="help-block">
                      <span class="text-danger"><strong>{{ $errors->first('termos') }}</strong></span>
                    </span>
                    @endif
                  </div>
                </div>
              </fieldset>


              <div class="row">
                <div class="col-md-4 col-md-offset-4">
                  <button type="submit" class="btn btn-primary btn-block btn-loading">Submeter Proposta</button>
                </div>
              </div>
            </form>

        </div>
      </div> <!-- quadro -->
    </div>
  </div> <!--container -->
</div> <!-- content -->
@endsection
