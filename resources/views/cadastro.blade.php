@extends('master')
@section('title', 'Home')

@section('content')
<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">
      <!-- INFORMAÇÕES -->
      <div class="col-md-8 col-md-offset-2">
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
            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            Preencha o formulário abaixo para ter acesso ao sistema. Todos os campos são obrigatórios.
          </div>

          <form method="post" action="{{ route('register') }}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <fieldset>
              <legend>Informações Pessoais</legend>
              <div class="row">
                <div class="form-group col-md-6">
                  <label>Nome</label>
                  <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="{{old('nome')}}">
                </div>
                <div class="form-group col-md-6">
                  <label>Sobrenome</label>
                  <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" value="{{old('sobrenome')}}">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-5">
                  <label>CPF</label>
                  <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF" value="{{old('cpf')}}">
                </div>
                <div class="form-group col-md-5">
                  <label>RG</label>
                  <input type="text" id="rg" name="rg" class="form-control" placeholder="RG" value="{{old('cpf')}}">
                </div>
                <div class="form-group col-md-2">
                  <label>Sexo</label><br/>
                  <input type="radio" name="sexo" value="F"/> F&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="sexo" value="M"/> M
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-4">
                  <label>Cidade</label>
                  <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade" value="{{old('cidade')}}">
                </div>
                <div class="form-group col-md-4">
                  <label>Estado</label>
                  <input type="text" id="estado" name="estado" class="form-control" placeholder="Estado" value="{{old('estado')}}">
                </div>
                <div class="form-group col-md-4">
                  <label>País</label>
                  <input type="text" id="pais" name="pais" class="form-control" placeholder="País" value="{{old('pais')}}">
                </div>
              </div>
            </fieldset>

            <fieldset>
              <legend>Dados de Acesso ao Sistema</legend>
              <div class="row">
                <div class="form-group col-md-12">
                  <label for="email-cad">E-mail</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{old('email')}}">
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="senha-cad">Senha</label>
                  <input type="password" class="form-control" id="senha" name="password" placeholder="Senha">
                </div>
                <div class="form-group col-md-6">
                  <label for="repsenha-cad">Repita sua senha</label>
                  <input type="password" class="form-control" id="senha-confirma" name="password_confirmation" placeholder="Senha">
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
