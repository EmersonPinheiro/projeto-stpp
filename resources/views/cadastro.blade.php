@extends('master')
@section('title', 'Cadastro')

@section('content')
<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">
      <!-- INFORMAÇÕES -->
      <div class="col-md-10 col-md-offset-1">
        <!-- CADASTRO -->
        <div class="quadro">
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
            Preencha o formulário abaixo para ter acesso ao sistema. Os campos com asterisco (*) são obrigatórios.
          </div>

          <form method="post" action="{{ route('register') }}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <input type="hidden" name="tipo" value="propositor">

            <!-- DADOS PESSOAIS -->
            <fieldset>
              <legend>Dados Pessoais</legend>
              <div class="row">
                <div class="form-group col-md-5">
                  <label for="nome">Nome *</label>
                  <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="{{old('nome')}}" pattern="[a-zA-Z]+">
                </div>
                <div class="form-group col-md-5">
                  <label for="sobrenome">Sobrenome *</label>
                  <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" value="{{old('sobrenome')}}">
                </div>
                <!-- ARRUMAR -->
                <div class="form-group col-md-2">
                  <label>Sexo *</label><br/>
                  <input type="radio" name="sexo" value="F"/> F&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="sexo" value="M"/> M
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="cpf">CPF *</label>
                  <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF (somente números)" value="{{old('cpf')}}" pattern="[0-9]{11}" maxlength="11">
                </div>
                <div class="form-group col-md-4">
                  <label for="rg">RG *</label>
                  <input type="text" id="rg" name="rg" class="form-control" placeholder="RG (somente números)" value="{{old('rg')}}">
                </div>
                <div class="col-md-4">
                  <label for="estado_civil">Estado Civil *</label>
                  <input type="text" class="form-control" id="estado_civil" name="estado_civil" placeholder="Estado Civil" value="{{old('estado_civil')}}">
                </div>
              </div>
            </fieldset>

            <!-- DADOS INSTITUCIONAIS -->
            <fieldset>
              <legend>Dados Institucionais</legend>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="instituicao">Instituição *</label>
                  <input type="text" class="form-control" id="instituicao" name="instituicao" placeholder="Instituição" value="{{old('instituicao')}}">
                </div>
                <div class="form-group col-md-4">
                  <label for="setor">Setor</label>
                  <input type="text" class="form-control" id="setor" name="setor" placeholder="Setor" value="{{old('setor')}}">
                </div>
                <div class="form-group col-md-4">
                  <label for="departamento">Departamento</label>
                  <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Departamento" value="{{old('departamento')}}">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="grande_area">Grande Área *</label>
                  <input type="text" class="form-control" id="grande_area" name="grande_area" placeholder="Grande Área" value="{{old('grande_area')}}">
                </div>
                <div class="form-group col-md-6">
                  <label for="area_conhecimento">Área de Conhecimento *</label>
                  <input type="text" class="form-control" id="area_conhecimento" name="area_conhecimento" placeholder="Área de Conhecimento" value="{{old('area_conhecimento')}}">
                </div>
              </div>
              <div class="row">
                  <div class="form-group col-md-6">
                  <label for="subarea">Subarea</label>
                  <input type="text" class="form-control" id="subarea" name="subarea" placeholder="Subarea" value="{{old('subarea')}}">
                </div>
                <div class="form-group col-md-6">
                  <label for="especialidade">Especialidade</label>
                  <input type="text" class="form-control" id="especialidade" name="especialidade" placeholder="Especialidade" value="{{old('especialidade')}}">

                </div>
              </div>
            </fieldset>

            <!-- DADOS DE CONTATO -->
            <fieldset>
              <legend>Dados de Contato</legend>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="logradouro">Logradouro *</label>
                  <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Rua, Avenida, Praça, ..." value="{{old('logradouro')}}">
                </div>
                <div class="col-md-4">
                  <label for="Bairro">Bairro *</label>
                  <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="{{old('bairro')}}">
                </div>
                <div class="col-md-4">
                  <label for="cep">CEP *</label>
                  <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP (somente números)"value="{{old('cep')}}">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="cidade">Cidade *</label>
                  <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade" value="{{old('cidade')}}">
                </div>
                <div class="form-group col-md-4">
                  <label for="estado">Estado *</label>
                  <input type="text" id="estado" name="estado" class="form-control" placeholder="Estado" value="{{old('estado')}}">
                </div>
                <div class="form-group col-md-4">
                  <label for="pais">País *</label>
                  <input type="text" id="pais" name="pais" class="form-control" placeholder="País" value="{{old('pais')}}">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-3">
                  <label for="telefone">Telefone *</label>
                  <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="{{old('telefone')}}">
                </div>
                <div class="form-group col-md-3">
                  <label for="telefone_secundario">Telefone secundário</label>
                  <input type="text" class="form-control" id="telefone_secundario" name="telefone_secundario" placeholder="Telefone secundário" value="{{old('telefone_secundario')}}">
                </div>
                <div class="form-group col-md-6">
                  <label for="email_secundario">E-mail secundário</label>
                  <input type="email" class="form-control" id="email_secundario" name="email_secundario" placeholder="E-mail secundário" value="{{old('email_secundario')}}">
                </div>
              </div>
            </fieldset>

            <!-- DADOS DE ACESSO AO SISTEMA -->
            <fieldset>
              <legend>Dados de Acesso ao Sistema</legend>
              <div class="alert alert-warning" role="alert">
                Atenção! Os dados a seguir serão utilizados por você para fazer login.
              </div>
              <div class="row">
                <div class="form-group col-md-12">
                  <label for="email-cad">E-mail *</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{old('email')}}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="senha">Senha *</label>
                  <input type="password" class="form-control" id="senha" name="password" placeholder="Senha">
                </div>
                <div class="form-group col-md-6">
                  <label for="confirma_senha">Confirme sua senha *</label>
                  <input type="password" class="form-control" id="confirma_senha" name="password_confirmation" placeholder="Senha">

                </div>
              </div>
            </fieldset>

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
