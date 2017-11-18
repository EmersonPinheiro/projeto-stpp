@extends('master')
@section('title', 'Informações Adicionais')

@section('content')
<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <!-- CADASTRAR INFORMAÇÕES ADICIONAIS -->
        <div class="quadro">
          <!-- RETORNAR-->
            <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span>Voltar para INSERIR NOME DA PROPOSTA?</a>

            <!-- TÍTULO -->
            <h3><span class="glyphicon glyphicon-paperclip glyphicon-space"></span><strong>Cadastro de Informações Adicionais</strong></h3>

            @if (!$errors->isEmpty())
              <!-- ERRO -->
              <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p><span class="glyphicon glyphicon-exclamation-sign glyphicon-space"></span>
                Ops! Algo deu errado.</p>
              </div>
            @else
              <!-- INFORMAÇÕES-->
              <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <span class="glyphicon glyphicon-info-sign glyphicon-space" aria-hidden="true"></span>
                Preencha o formulário abaixo com as informações adicionais da obra. Somente o administrador do sistema pode editá-las, mas as mesmas podem ser exibidas para ambos o administrador e o autor da proposta.
              </div>
            @endif

            <!-- STATUS -->
            @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
            @endif

            <!-- FORMULÁRIO DE SUBMISSÃO-->
            <form method="post">
              <!-- TODO: VERIFICAR NECESSIDADE DESTES CAMPOS -->
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <!-- DADOS DA OBRA -->
              <fieldset>
                <legend>Dados da Obra</legend>
                <div class="row">
                  <div class="form-group col-md-4 {{ $errors->has('isbn') ? 'has-error' :'' }}">
                    <label class="control-label" for="isbn">ISBN *</label>
                    <input type="number" class="form-control" id="isbn" name="isbn" placeholder="ISBN" value="{{old('isbn')}}" maxlength="100">
                    @if ($errors->has('isbn'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('isbn') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-2 {{ $errors->has('edicao') ? 'has-error' :'' }}">
                    <label class="control-label" for="edicao">Edição *</label>
                    <input type="number" class="form-control" id="edicao" name="edicao" placeholder="Edição" value="{{old('edicao')}}" maxlength="2">
                    @if ($errors->has('edicao'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('edicao') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-2 {{ $errors->has('volume') ? 'has-error' :'' }}">
                    <label class="control-label" for="volume">Volume *</label>
                    <input type="number" class="form-control" id="volume" name="volume" placeholder="Volume" value="{{old('volume')}}" maxlength="2">
                    @if ($errors->has('volume'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('volume') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-2 {{ $errors->has('ano') ? 'has-error' :'' }}">
                    <label class="control-label" for="ano">Ano de Publicação *</label>
                    <input type="number" class="form-control" id="ano" name="ano" placeholder="Ano" value="{{old('ano')}}" maxlength="4">
                    @if ($errors->has('ano'))
                    <span class="help-block">
                      <span class="text-danger"><strong>{{ $errors->first('ano') }}</strong></span>
                    </span>
                    @endif
                  </div>

                  <div class="form-group col-md-2 {{ $errors->has('paginas') ? 'has-error' :'' }}">
                    <label class="control-label" for="paginas">Nº de Páginas *</label>
                    <input type="number" class="form-control" id="paginas" name="paginas" placeholder="Nº de Páginas" value="{{old('paginas')}}" maxlength="5">
                    @if ($errors->has('paginas'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('paginas') }}</strong></span>
                        </span>
                    @endif
                  </div>
                </div>

              <!-- TÉCNICOS CATALOGRAFIA -->
              <fieldset>
                <legend>Dados dos Técnicos de Catalografia</legend>
                <div class="row">

                  <div class="form-group col-md-3 {{ $errors->has('nome') ? 'has-error' :'' }}">
                    <label class="control-label" for="nome">Nome *</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="{{old('nome')}}" maxlength="50">
                    @if ($errors->has('nome'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('nome') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-4 {{ $errors->has('sobrenome') ? 'has-error' :'' }}">
                    <label class="control-label" for="sobrenome">Sobrenome *</label>
                    <input type="text" id="sobrenome" name="sobrenome" class="form-control" placeholder="Sobrenome" value="{{old('sobrenome')}}" maxlength="100">
                    @if ($errors->has('sobrenome'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('sobrenome') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <!-- RECUPERAR VALOR ANTIGO!!!! -->
                  <div class="form-group col-md-2 {{ $errors->has('sexo') ? 'has-error' :'' }}">
                    <label for="sexo" class="control-label">Sexo *</label>
                    <select class="form-control" id="sexo" name="sexo">
                      <option value="F" selected>F</option>
                      <option value="M">M</option>
                    </select>
                    @if ($errors->has('sexo'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('sexo') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <!-- RECUPERAR VALOR ANTIGO!!!! -->
                  <div class="form-group col-md-3 {{ $errors->has('estado_civil') ? 'has-error' :'' }}">
                    <label class="control-label" for="estado_civil">Estado Civil *</label>
                    <select class="form-control" id="estado_civil" name="estado_civil">
                      <option value="Solteiro">Solteiro(a)</option>
                        <option value="Casado">Casado(a)</option>
                        <option value="Separado">Separado(a)</option>
                        <option value="Divorciado">Divorciado(a)</option>
                        <option value="Viúvo">Viúvo(a)</option>
                        <option value="Amasiado">Amasiado(a)</option>
                    </select>
                    @if ($errors->has('estado_civil'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('estado_civil') }}</strong></span>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-3 {{ $errors->has('cpf') ? 'has-error' :'' }}">
                    <label class="control-label" for="cpf">CPF * </label>
                    <!-- AJUDA -->
                    <small><a href="javascript:;" data-toggle="popover" data-content="O campo CPF deve conter apenas números. Não é permitida a inserção de pontos ou traços." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                    <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF (somente números)" value="{{old('cpf')}}" maxlength="11">
                    @if ($errors->has('cpf'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('cpf') }}</strong></span>
                        </span>
                    @endif
                  </div>


                  <div class="form-group col-md-3 {{ $errors->has('rg') ? 'has-error' :'' }}">
                    <label class="control-label" for="rg">RG *</label>
                    <!-- AJUDA -->
                    <small><a href="javascript:;" data-toggle="popover" data-content="O campo RG deve conter apenas números. Não é permitida a inserção de pontos ou traços." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                    <input type="text" id="rg" name="rg" class="form-control" placeholder="RG (somente números)" value="{{old('rg')}}" maxlength="14">
                    @if ($errors->has('rg'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('rg') }}</strong></span>
                        </span>
                    @endif
                  </div>

                  <div class="form-group col-md-4 {{ $errors->has('email') ? 'has-error' :'' }}">
                    <label class="control-label" for="email_secundario">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{old('email')}}" maxlength="100">
                    @if ($errors->has('email'))
                    <span class="help-block">
                      <span class="text-danger"><strong>{{ $errors->first('email') }}</strong></span>
                    </span>
                    @endif
                  </div>

                  <div class="form-group col-md-2 {{ $errors->has('telefone') ? 'has-error' :'' }}">
                    <label class="control-label" for="telefone">Telefone *</label>
                    <!-- AJUDA-->
                    <small><a href="javascript:;" data-toggle="popover" data-content="O campo Telefone deve conter apenas números. Não é permitida a inserção de parênteses ou traços. Informe o deu DDD." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="{{old('telefone')}}" maxlength="14">
                    @if ($errors->has('telefone'))
                        <span class="help-block">
                            <span class="text-danger"><strong>{{ $errors->first('telefone') }}</strong></span>
                        </span>
                    @endif
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button type="button" name="button" class="btn btn-success"><span class="glyphicon glyphicon-plus glyphicon-space"></span>Adicionar Técnico</button>
                  </div>
                </div>

              </fieldset>

              <hr>

              <div class="row">
                <div class="col-md-4 col-md-offset-4">
                  <button type="submit" class="btn btn-primary btn-block">Submeter Informações Adicionais</button>
                </div>
              </div>
            </form>
        </div>
      </div> <!-- quadro -->
    </div>
  </div> <!--container -->
</div> <!-- content -->
@endsection
