@extends('master')
@section('title', 'Cadastro')

@section('content')
<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <!-- CADASTRO -->
        <div class="quadro">
          <!-- RETORNAR -->
          <a href="/home"><span class="glyphicon glyphicon-menu-left"></span>Voltar para a Página Inicial</a>

          <!-- TÍTULO -->
          <h3><span class="glyphicon glyphicon-user glyphicon-space"></span><strong>Cadastro de Propositor</strong></h3>

          @if (!$errors->isEmpty())
            <!-- ERRO -->
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <p><span class="glyphicon glyphicon-exclamation-sign glyphicon-space"></span>
              Ops! Algo deu errado.</p>
              <p>Preencha corretamente o formulário abaixo para ter acesso ao sistema. Os campos com asterisco (*) são obrigatórios.</p>
            </div>
          @else
            <!-- INFORMAÇÕES -->
            <div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <span class="glyphicon glyphicon-question-sign glyphicon-space" aria-hidden="true"></span>
              Preencha o formulário abaixo para ter acesso ao sistema. Os campos com asterisco (*) são obrigatórios.
            </div>
          @endif

          <!-- STATUS -->
          @if (session('status'))
              <div class="alert alert-info">
                  {{ session('status') }}
              </div>
          @endif

          <!-- FORMULÁRIO DE CADASTRO -->
          <form method="post" action="{{ route('register') }}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <input type="hidden" name="tipo" value="propositor">

            <!-- DADOS PESSOAIS -->
            <fieldset>
              <legend>Dados Pessoais</legend>
              <div class="row">

                <div class="form-group col-md-5 {{ $errors->has('nome') ? 'has-error' :'' }}">
                  <label class="control-label" for="nome">Nome *</label>
                  <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="{{old('nome')}}" maxlength="50">
                  @if ($errors->has('nome'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('nome') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-5 {{ $errors->has('sobrenome') ? 'has-error' :'' }}">
                  <label class="control-label" for="sobrenome">Sobrenome *</label>
                  <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" value="{{old('sobrenome')}}" maxlength="100">
                  @if ($errors->has('sobrenome'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('sobrenome') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-2 {{ $errors->has('sexo') ? 'has-error' :'' }}">
                  <label for="sexo" class="control-label">Sexo *</label>
                  <select class="form-control" id="sexo" name="sexo">
                    <option value="">Selecione</option>
                    <option value="F" @if (old('sexo') == 'F') selected="selected" @endif>F</option>
                    <option value="M" @if (old('sexo') == 'M') selected="selected" @endif>M</option>
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
                  <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF (somente números)" value="{{old('cpf')}}" maxlength="11">
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
                  <input type="text" id="rg" name="rg" class="form-control" placeholder="RG (somente números)" value="{{old('rg')}}" maxlength="14">
                  @if ($errors->has('rg'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('rg') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-4 {{ $errors->has('estado_civil') ? 'has-error' :'' }}">
                  <label class="control-label" for="estado_civil">Estado Civil *</label>
                  <select class="form-control" id="estado_civil" name="estado_civil">
                    <option value="">Selecione</option>
                    <option value="Solteiro" @if (old('estado_civil') == 'Solteiro') selected="selected" @endif>Solteiro</option>
                    <option value="Casado" @if (old('estado_civil') == 'Casado') selected="selected" @endif>Casado</option>
                    <option value="Separado" @if (old('estado_civil') == 'Separado') selected="selected" @endif>Separado</option>
                    <option value="Divorciado" @if (old('estado_civil') == 'Divorciado') selected="selected" @endif>Divorciado</option>
                    <option value="Viúvo" @if (old('estado_civil') == 'Viúvo') selected="selected" @endif>Viúvo</option>
                    <option value="Amasiado" @if (old('estado_civil') == 'Amasiado') selected="selected" @endif>Amasiado</option>
                  </select>
                  @if ($errors->has('estado_civil'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('estado_civil') }}</strong></span>
                      </span>
                  @endif
                </div>
              </div>
            </fieldset>

            <!-- DADOS INSTITUCIONAIS -->
            <fieldset>
              <legend>Dados Institucionais</legend>
              <div class="row">
                <div class="form-group col-md-5 {{ $errors->has('instituicao') ? 'has-error' :'' }}">
                  <label class="control-label" for="instituicao">Instituição *</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Instituição a qual você está vinculado." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="text" class="form-control" id="instituicao" name="instituicao" placeholder="Instituição" value="{{old('instituicao')}}" maxlength="100">
                  @if ($errors->has('instituicao'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('instituicao') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-2 {{ $errors->has('sigla') ? 'has-error' :'' }}">
                  <label for="sigla" class="control-label">Sigla</label>
                  <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Sigla" value="{{old('sigla')}}" maxlength="20">
                  @if ($errors->has('sigla'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('sigla') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-5 {{ $errors->has('vinculo') ? 'has-error' :'' }}">
                  <label class="control-label" for="vinculo">Vínculo Institucional</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com o Setor ou Departamento aos quais você está vinculado (opcional)." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="text" class="form-control" id="vinculo" name="vinculo" placeholder="Setor, Departamento, ..." value="{{old('vinculo')}}" maxlength="200">
                  @if ($errors->has('vinculo'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('vinculo') }}</strong></span>
                      </span>
                  @endif
                </div>
              </div>
<!--
              <div class="row">
                <div class="form-group col-md-6 {{ $errors->has('grande_area') ? 'has-error' :'' }}">
                  <label class="control-label" for="grande_area">Grande Área *</label>

                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com sua Grande Área definida pelo CNPQ." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="text" class="form-control" id="grande_area" name="grande_area" placeholder="Grande Área" value="{{old('grande_area')}}" maxlength="100">
                  @if ($errors->has('grande_area'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('grande_area') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-6 {{ $errors->has('area_conhecimento') ? 'has-error' :'' }}">
                  <label class="control-label" for="area_conhecimento">Área de Conhecimento *</label>

                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com sua Área de Conhecimento definida pelo CNPQ." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="text" class="form-control" id="area_conhecimento" name="area_conhecimento" placeholder="Área de Conhecimento" value="{{old('area_conhecimento')}}" maxlength="100">
                  @if ($errors->has('area_conhecimento'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('area_conhecimento') }}</strong></span>
                      </span>
                  @endif
                </div>
              </div>

              <div class="row">
                  <div class="form-group col-md-6 {{ $errors->has('subarea') ? 'has-error' :'' }}">
                  <label class="control-label" for="subarea">Subarea</label>

                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com sua Subarea definida pelo CNPQ (opcional)." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="text" class="form-control" id="subarea" name="subarea" placeholder="Subarea" value="{{old('subarea')}}" maxlength="100">
                  @if ($errors->has('subarea'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('subarea') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-6 {{ $errors->has('especialidade') ? 'has-error' :'' }}">
                  <label class="control-label" for="especialidade">Especialidade</label>

                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com sua Especialidade definida pelo CNPQ (opcional)." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="text" class="form-control" id="especialidade" name="especialidade" placeholder="Especialidade" value="{{old('especialidade')}}" maxlength="100">
                  @if ($errors->has('especialidade'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('especialidade') }}</strong></span>
                      </span>
                  @endif
                </div>
              </div>
            </fieldset>-->

            <!-- DADOS DE CONTATO -->
            <fieldset>
              <legend>Dados de Contato</legend>
              <div class="row">
                <div class="form-group col-md-4 {{ $errors->has('logradouro') ? 'has-error' :'' }}">
                  <label class="control-label" for="logradouro">Logradouro *</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo sua Rua, Avenida, Praça, etc. e o número de sua residência." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Rua, Avenida, Praça, ..." value="{{old('logradouro')}}" maxlength="255">
                  @if ($errors->has('logradouro'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('logradouro') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-4 {{ $errors->has('bairro') ? 'has-error' :'' }}">
                  <label class="control-label" for="Bairro">Bairro *</label>
                  <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="{{old('bairro')}}" maxlength="50">
                  @if ($errors->has('bairro'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('bairro') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-4 {{ $errors->has('cep') ? 'has-error' :'' }}">
                  <label class="control-label" for="cep">CEP *</label>
                  <!-- AJUDA-->
                  <small><a href="javascript:;" data-toggle="popover" data-content="O campo CEP deve conter apenas números. Não é permitida a inserção de traços." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP (somente números)"value="{{old('cep')}}">
                  @if ($errors->has('cep'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('cep') }}</strong></span>
                      </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-4 {{ $errors->has('cidade') ? 'has-error' :'' }}">
                  <label class="control-label" for="cidade">Cidade *</label>
                  <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade" value="{{old('cidade')}}" maxlength="50">
                  @if ($errors->has('cidade'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('cidade') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-4 {{ $errors->has('estado') ? 'has-error' :'' }}">
                  <label class="control-label" for="estado">Estado *</label>
                  <input type="text" id="estado" name="estado" class="form-control" placeholder="Estado" value="{{old('estado')}}" maxlength="50">
                  @if ($errors->has('estado'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('estado') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-4 {{ $errors->has('pais') ? 'has-error' :'' }}">
                  <label class="control-label" for="pais">País *</label>
                  <input type="text" id="pais" name="pais" class="form-control" placeholder="País" value="{{old('pais')}}" maxlength="50">
                  @if ($errors->has('pais'))
                  <span class="help-block">
                    <span class="text-danger"><strong>{{ $errors->first('pais') }}</strong></span>
                  </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-3 {{ $errors->has('telefone') ? 'has-error' :'' }}">
                  <label class="control-label" for="telefone">Telefone *</label>
                  <!-- AJUDA-->
                  <small><a href="javascript:;" data-toggle="popover" data-content="O campo Telefone deve conter apenas números. Não é permitida a inserção de parênteses ou traços. Informe o deu DDD." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="{{old('telefone')}}" maxlength="14">
                  @if ($errors->has('telefone'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('telefone') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-3 {{ $errors->has('telefone_secundario') ? 'has-error' :'' }}">
                  <label class="control-label" for="telefone_secundario">Telefone secundário</label>
                  <!-- AJUDA-->
                  <small><a href="javascript:;" data-toggle="popover" data-content="O campo Telefone Secundário deve conter apenas números. Não é permitida a inserção de parênteses ou traços. Informe o deu DDD. Este campo é opcional." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="text" class="form-control" id="telefone_secundario" name="telefone_secundario" placeholder="Telefone secundário" value="{{old('telefone_secundario')}}" maxlength="14">
                  @if ($errors->has('telefone_secundario'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('telefone_secundario') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-6 {{ $errors->has('email_secundario') ? 'has-error' :'' }}">
                  <label class="control-label" for="email_secundario">E-mail secundário</label>
                  <!-- AJUDA-->
                  <small><a href="javascript:;" data-toggle="popover" data-content="<span class='text-warning'>Atenção!</span> Este e-mail <strong>NÃO</strong> será utilizado por você para acessar o sistema (opcional)." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="email" class="form-control" id="email_secundario" name="email_secundario" placeholder="E-mail secundário" value="{{old('email_secundario')}}" maxlength="100">
                  @if ($errors->has('email_secundario'))
                  <span class="help-block">
                    <span class="text-danger"><strong>{{ $errors->first('email_secundario') }}</strong></span>
                  </span>
                  @endif
                </div>
              </div>
            </fieldset>

            <!-- DADOS DE ACESSO AO SISTEMA -->
            <fieldset>
              <legend>Dados de Acesso ao Sistema</legend>
              <div class="alert alert-warning" role="alert">
                <span class="glyphicon glyphicon-alert glyphicon-space"></span><strong>Atenção!</strong> Os dados a seguir serão utilizados por você para fazer login.
              </div>
              <div class="row">
                <div class="form-group col-md-12 {{ $errors->has('email') ? 'has-error' :'' }}">
                  <label class="control-label" for="email-cad">E-mail *</label>
                  <!-- AJUDA-->
                  <small><a href="javascript:;" data-toggle="popover" data-content="Este e-mail será utilizado por você para acessar o sistema." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{old('email')}}" maxlength="100">
                  @if ($errors->has('email'))
                  <span class="help-block">
                    <span class="text-danger"><strong>{{ $errors->first('email') }}</strong></span>
                  </span>
                  @endif
                </div>
              </div>

              <div class="row">
                <div class="form-group col-md-6 {{ $errors->has('password') | !$errors->isEmpty() ? 'has-error' :'' }}">
                  <label class="control-label" for="senha">Senha *</label>
                  <!-- AJUDA-->
                  <small><a href="javascript:;" data-toggle="popover" data-content="Sua senha deve conter no mínimo 6 caracteres." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-question-sign"></span></a></small>
                  <input type="password" class="form-control" id="senha" name="password" placeholder="Senha" maxlength="60">
                  @if ($errors->has('password'))
                  <span class="help-block">
                    <span class="text-danger"><strong>{{ $errors->first('password') }}</strong></span>
                  </span>
                  @endif
                </div>

                <div class="form-group col-md-6 {{ $errors->has('password_confirmation') | !$errors->isEmpty() ? 'has-error' :'' }}">
                  <label class="control-label" for="confirma_senha">Repita sua senha *</label>
                  <input type="password" class="form-control" id="confirma_senha" name="password_confirmation" placeholder="Repita sua senha" maxlength="60">
                  @if ($errors->has('password_confirmation'))
                  <span class="help-block">
                    <span class="text-danger"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                  </span>
                  @endif
                </div>
              </div>

            </fieldset>

            <hr/>

            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
              </div>
            </div>
          </form>
        </div> <!-- quadro -->
      </div> <!-- col -->
    </div> <!-- row -->
  </div> <!-- container -->
</div> <!-- content -->

@endsection
