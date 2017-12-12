@extends('master')
@section('title', 'Editar Perfil')

@section('content')
<div class="content">
  <div class="container">
    <div class="row">

      <div class="col-md-10 col-md-offset-1">
        <div class="quadro">
          <!-- RETORNAR -->
          <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>

          <!-- TÍTULO -->
          <h3><span class="glyphicon glyphicon-user glyphicon-space"></span><strong>Editar Perfil</strong></h3>

          @if (!$errors->isEmpty())
            <!-- ERRO -->
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <p><span class="glyphicon glyphicon-exclamation-sign glyphicon-space"></span>
              Ops! Algo deu errado.</p>
              @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach
            </div>
          @endif

          <!-- STATUS -->
          @if (session('status'))
              <div class="alert alert-info">
                  {{ session('status') }}
              </div>
          @endif

          <!-- FORMULÁRIO DE CADASTRO -->
          <form method="post">
            <!-- TODO: VERIFICAR ESTES CAMPOS -->
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <input type="hidden" name="cod_pessoa" value="{!! $pessoaUsuario->cod_pessoa !!}">
            <input type="hidden" name="cod_usuario" value="{!! $pessoaUsuario->cod_usuario !!}">
            <input type="hidden" name="cod_instituicao" value="{!! $instituicaoVinculo->cod_instituicao !!}">
            <input type="hidden" name="cod_vinculo" value="{!! $instituicaoVinculo->cod_vinculo !!}">
            <input type="hidden" name="cod_cidade" value="{!! $localizacao->cod_cidade !!}">
            <input type="hidden" name="cod_est_prov" value="{!! $localizacao->cod_est_prov !!}">
            <input type="hidden" name="cod_pais" value="{!! $localizacao->cod_pais !!}">
            <input type="hidden" name="cod_telefone" value="{!! $telefone->cod_telefone !!}">

            <!-- DADOS PESSOAIS E INSTITUCIONAIS -->
            <!-- TODO: RECUPERAR VALORES DO BANCO -->
            <fieldset>
              <legend>Dados Pessoais e Institucionais</legend>
              <div class="row">

                <div class="form-group col-md-5 {{ $errors->has('nome') ? 'has-error' :'' }}">
                  <label class="control-label" for="nome">Nome *</label>
                  <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="{!! $pessoaUsuario->nome !!}" maxlength="50">
                  @if ($errors->has('nome'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('nome') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-5 {{ $errors->has('sobrenome') ? 'has-error' :'' }}">
                  <label class="control-label" for="sobrenome">Sobrenome *</label>
                  <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" value="{!! $pessoaUsuario->sobrenome !!}" maxlength="100">
                  @if ($errors->has('sobrenome'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('sobrenome') }}</strong></span>
                      </span>
                  @endif
                </div>

                <!-- TODO: RECUPERAR VALOR ANTIGO!!!! -->
                <div class="form-group col-md-2 {{ $errors->has('sexo') ? 'has-error' :'' }}">
                  <label for="sexo" class="control-label">Sexo *</label>
                  <?php !$errors->isEmpty() ? $sexo_aux=old('sexo') : $sexo_aux=$pessoaUsuario->sexo ?>
                  <select class="form-control" id="sexo" name="sexo">
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
                <div class="form-group col-md-4 {{ $errors->has('cpf') ? 'has-error' :'' }}">
                  <label class="control-label" for="cpf">CPF * </label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="O campo CPF deve conter apenas números. Não é permitida a inserção de pontos ou traços." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                  <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF (somente números)" value="{!! $pessoaUsuario->cpf !!}" maxlength="11">
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
                  <input type="text" id="rg" name="rg" class="form-control" placeholder="RG (somente números)" value="{!! $pessoaUsuario->rg !!}" maxlength="14">
                  @if ($errors->has('rg'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('rg') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-4 {{ $errors->has('estado_civil') ? 'has-error' :'' }}">
                  <label class="control-label" for="estado_civil">Estado Civil *</label>
                  <?php !$errors->isEmpty() ? $estado_civil_aux=old('estado_civil') : $estado_civil_aux=$pessoaUsuario->estado_civil ?>
                  <select class="form-control" id="estado_civil" name="estado_civil">
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
                <div class="form-group col-md-5 {{ $errors->has('instituicao') ? 'has-error' :'' }}">
                  <label class="control-label" for="instituicao">Instituição *</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com a Instituição a qual você está vinculado." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                  <input type="text" class="form-control" id="instituicao" name="instituicao" placeholder="Instituição" value="{!! $instituicaoVinculo->nome_instituicao !!}" maxlength="100">
                  @if ($errors->has('instituicao'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('instituicao') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-2 {{ $errors->has('sigla') ? 'has-error' :'' }}">
                  <label for="sigla" class="control-label">Sigla</label>
                  <input type="text" class="form-control" id="sigla" name="sigla" placeholder="Sigla" value="{!! $instituicaoVinculo->sigla !!}" maxlength="20">
                  @if ($errors->has('sigla'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('sigla') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-5 {{ $errors->has('vinculo') ? 'has-error' :'' }}">
                  <label class="control-label" for="setor">Vínculo Institucional</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo com o Setor ou Departamento aos quais você está vinculado (opcional)." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                  <input type="text" class="form-control" id="vinculo" name="vinculo" placeholder="Setor, Departamento, ..." value="{!! $instituicaoVinculo->nome_vinculo !!}" maxlength="200">
                  @if ($errors->has('vinculo'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('vinculo') }}</strong></span>
                      </span>
                  @endif
                </div>
              </div>

              @role('parecerista')
              <!-- AREAS DE CONHECIMENTO  -->
              <input type="hidden" name="cod_grande_area" value="{!! $areasConhecimento->cod_grande_area !!}">
              <input type="hidden" name="cod_area_conhec" value="{!! $areasConhecimento->cod_area_conhec !!}">
              <input type="hidden" name="cod_subarea" value="{!! $areasConhecimento->cod_subarea !!}">
              <input type="hidden" name="cod_especialidade" value="{!! $areasConhecimento->cod_especialidade !!}">

              <div class="row">
                <div class="form-group col-md-6 {{ $errors->has('grande_area') ? 'has-error' :'' }}">
                  <label class="control-label" for="grande_area">Grande área *</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="" title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                  <input type="text" class="form-control" id="grande_area" name="grande_area" placeholder="Grande área" value="{!! $areasConhecimento->nome_grande_area !!}" maxlength="255">
                  @if ($errors->has('grande_area'))
                  <span class="help-block">
                    <span class="text-danger"><strong>{{ $errors->first('grande_area') }}</strong></span>
                  </span>
                  @endif
                </div>
                <div class="form-group col-md-6 {{ $errors->has('area_conhecimento') ? 'has-error' :'' }}">
                  <label class="control-label" for="area_conhecimento">Área de conhecimento *</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="" title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                  <input type="text" class="form-control" id="area_conhecimento" name="area_conhecimento" placeholder="Área de conhecimento" value="{!! $areasConhecimento->nome_area_conhecimento !!}" maxlength="255">
                  @if ($errors->has('area_conhecimento'))
                  <span class="help-block">
                    <span class="text-danger"><strong>{{ $errors->first('area_conhecimento') }}</strong></span>
                  </span>
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6 {{ $errors->has('subarea') ? 'has-error' :'' }}">
                  <label class="control-label" for="subarea">Subárea *</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="" title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                  <input type="text" class="form-control" id="subarea" name="subarea" placeholder="Subárea" value="{!! $areasConhecimento->nome_subarea !!}" maxlength="255">
                  @if ($errors->has('subarea'))
                  <span class="help-block">
                    <span class="text-danger"><strong>{{ $errors->first('subarea') }}</strong></span>
                  </span>
                  @endif
                </div>
                <div class="form-group col-md-6 {{ $errors->has('especialidade') ? 'has-error' :'' }}">
                  <label class="control-label" for="especialidade">Especialidade *</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo sua Rua, Avenida, Praça, etc. e o número de sua residência." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                  <input type="text" class="form-control" id="especialidade" name="especialidade" placeholder="Especialidade" value="{!! $areasConhecimento->nome_especialidade !!}" maxlength="255">
                  @if ($errors->has('especialidade'))
                  <span class="help-block">
                    <span class="text-danger"><strong>{{ $errors->first('especialidade') }}</strong></span>
                  </span>
                  @endif
                </div>
              </div>
              @endrole

            </fieldset>


            <!-- DADOS DE CONTATO -->
            <fieldset>
              <legend>Dados de Contato</legend>
              <div class="row">
                <div class="form-group col-md-4 {{ $errors->has('logradouro') ? 'has-error' :'' }}">
                  <label class="control-label" for="logradouro">Logradouro *</label>
                  <!-- AJUDA -->
                  <small><a href="javascript:;" data-toggle="popover" data-content="Preencha este campo sua Rua, Avenida, Praça, etc. e o número de sua residência." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                  <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Rua, Avenida, Praça, ..." value="{!! $pessoaUsuario->logradouro !!}" maxlength="255">
                  @if ($errors->has('logradouro'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('logradouro') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-4 {{ $errors->has('bairro') ? 'has-error' :'' }}">
                  <label class="control-label" for="Bairro">Bairro *</label>
                  <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="{!! $pessoaUsuario->bairro !!}" maxlength="50">
                  @if ($errors->has('bairro'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('bairro') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-4 {{ $errors->has('cep') ? 'has-error' :'' }}">
                  <label class="control-label" for="cep">CEP *</label>
                  <!-- AJUDA-->
                  <small><a href="javascript:;" data-toggle="popover" data-content="O campo CEP deve conter apenas números. Não é permitida a inserção de traços." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                  <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP (somente números)"value="{!! $pessoaUsuario->CEP !!}">
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
                  <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade" value="{!! $localizacao->nome_cidade !!}" maxlength="50">
                  @if ($errors->has('cidade'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('cidade') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-4 {{ $errors->has('estado') ? 'has-error' :'' }}">
                  <label class="control-label" for="estado">Estado *</label>
                  <input type="text" id="estado" name="estado" class="form-control" placeholder="Estado" value="{!! $localizacao->nome_estado_provincia !!}" maxlength="50">
                  @if ($errors->has('estado'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('estado') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-4 {{ $errors->has('pais') ? 'has-error' :'' }}">
                  <label class="control-label" for="pais">País *</label>
                  <input type="text" id="pais" name="pais" class="form-control" placeholder="País" value="{!! $localizacao->nome_pais !!}" maxlength="50">
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
                  <small><a href="javascript:;" data-toggle="popover" data-content="O campo Telefone deve conter apenas números. Não é permitida a inserção de parênteses ou traços. Informe o deu DDD." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                  <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="{!! $telefone->numero !!}" maxlength="14">
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
                  <input type="text" class="form-control" id="telefone_secundario" name="telefone_secundario" placeholder="Telefone secundário" value="" maxlength="14">
                  @if ($errors->has('telefone_secundario'))
                      <span class="help-block">
                          <span class="text-danger"><strong>{{ $errors->first('telefone_secundario') }}</strong></span>
                      </span>
                  @endif
                </div>

                <div class="form-group col-md-6 {{ $errors->has('email_secundario') ? 'has-error' :'' }}">
                  <label class="control-label" for="email_secundario">E-mail secundário</label>
                  <!-- AJUDA-->
                  <small><a href="javascript:;" data-toggle="popover" data-content="<span class='text-warning'>Atenção!</span> Este e-mail <strong>NÃO</strong> será utilizado por você para acessar o sistema (opcional)." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                  <input type="email" class="form-control" id="email_secundario" name="email_secundario" placeholder="E-mail secundário" value="" maxlength="100">
                  @if ($errors->has('email_secundario'))
                  <span class="help-block">
                    <span class="text-danger"><strong>{{ $errors->first('email_secundario') }}</strong></span>
                  </span>
                  @endif
                </div>
            </fieldset>

            <!-- DADOS DE ACESSO AO SISTEMA -->
            <fieldset>
              <legend>Dados de Acesso ao sistema</legend>
              <div class="row">
                <div class="form-group col-md-6 {{ $errors->has('email') ? 'has-error' :'' }}">
                  <label class="control-label" for="email">E-mail de Acesso ao Sistema e de Contato</label>
                  <!-- AJUDA-->
                  <small><a href="javascript:;" data-toggle="popover" data-content="<span class='text-warning'>Atenção!</span> Este e-mail <strong>SERÁ</strong> utilizado por você para acessar o sistema." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                  <input type="email" class="form-control" id="email" name="email" placeholder="E-mail secundário" value="{!! $pessoaUsuario->email !!}" maxlength="100">
                  @if ($errors->has('email'))
                  <span class="help-block">
                    <span class="text-danger"><strong>{{ $errors->first('email') }}</strong></span>
                  </span>
                  @endif
                </div>

                <div class="form-group col-md-6 {{ $errors->has('password') ? 'has-error' :'' }}">
                  <label class="control-label" for="password">Senha de acesso ao Sistema</label>
                  <!-- AJUDA-->
                  <!-- <small><a href="javascript:;" data-toggle="popover" data-content="<span class='text-warning'>Atenção!</span> Esta senha será utilizada por você para acessar o sistema." title="<strong>Ajuda</strong>"><span class="glyphicon glyphicon-info-sign"></span></a></small>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Nova senha" value="" maxlength="100">
                  @if ($errors->has('password'))
                  <span class="help-block">
                    <span class="text-danger"><strong>{{ $errors->first('password') }}</strong></span>
                  </span>
                  @endif -->
                  <a class="btn btn-primary btn-block" href="" role="button"><span class="glyphicon glyphicon-lock glyphicon-space"></span>Clique para alterar sua Senha</a>
                </div>
              </div>
            </fieldset>

            <hr>

            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-block">Enviar</button>
              </div>
            </div>
          </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
