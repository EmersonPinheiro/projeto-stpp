@extends('master')
@section('title', 'Home')

@section('content')
<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">
      <!-- INFORMAÇÕES -->
      <div class="col-md-6 col-md-offset-3">


        <!-- CADASTRO -->
        <div class="quadro">
          @foreach ($errors->all() as $error)
              <p class="alert alert-danger">{{ $error }}</p>
          @endforeach

          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif
          <form method="post" action="{{ route('register') }}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <input type="hidden" name="tipo" value="propositor">
            <fieldset>
              <legend>Informações Pessoais</legend>
              <div class="form-group col-md-12">
                <label>Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="{{old('nome')}}">
              </div>
              <div class="form-group col-md-12">
                <label>Sobrenome</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" value="{{old('sobrenome')}}">
              </div>
              <div class="form-group col-md-8">
                <label>CPF</label>
                <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF" value="{{old('cpf')}}">
              </div>
              <div class="form-group col-md-4">
                <label>Sexo</label><br/>
                <input type="radio" name="sexo" value="M"/> M&nbsp;&nbsp;&nbsp;
                <input type="radio" name="sexo" value="F"/> F
              </div>
              <div class="form-group col-md-12">
                <label>Cidade</label>
                <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade" value="{{old('cidade')}}">
              </div>
              <div class="form-group col-md-6">
                <label>Estado</label>
                <input type="text" id="estado" name="estado" class="form-control" placeholder="Estado" value="{{old('estado')}}">
              </div>
              <div class="form-group col-md-6">
                <label>País</label>
                <input type="text" id="pais" name="pais" class="form-control" placeholder="País" value="{{old('pais')}}">
              </div>
            </fieldset>

            <fieldset>
              <legend>Dados Institucionais</legend>
              <div class="form-group col-md-12">
                <label for="instituicao">Instituição</label>
                <input type="text" class="form-control" id="instituicao" name="instituicao" placeholder="Instituição" value="{{old('instituicao')}}">
              </div>
              <div class="form-group col-md-12">
                <label for="setor">Setor</label>
                <input type="text" class="form-control" id="setor" name="setor" placeholder="Setor" value="{{old('setor')}}">
              </div>
              <div class="form-group col-md-12">
                <label for="departamento">Departamento</label>
                <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Departamento" value="{{old('departamento')}}">
              </div>
            </fieldset>

            <fieldset>
              <legend>Dados de Acesso ao Sistema</legend>
              <div class="form-group col-md-12">
                <label for="email-cad">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{old('email')}}">
              </div>
              <div class="form-group col-md-12">
                <label for="senha-cad">Senha</label>
                <input type="password" class="form-control" id="senha" name="password" placeholder="Senha">
              </div>
              <div class="form-group col-md-12">
                <label for="repsenha-cad">Repita sua senha</label>
                <input type="password" class="form-control" id="senha-confirma" name="password_confirmation" placeholder="Senha">
              </div>
            </fieldset>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
