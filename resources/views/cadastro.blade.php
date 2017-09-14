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
          <form action="index.html">
            <fieldset>
              <legend>Informações Pessoais</legend>
              <div class="form-group col-md-12">
                <label>Nome</label>
                <input type="text" class="form-control" placeholder="Nome">
              </div>
              <div class="form-group col-md-12">
                <label>Sobrenome</label>
                <input type="text" class="form-control" placeholder="Sobrenome">
              </div>
              <div class="form-group col-md-8">
                <label>CPF</label>
                <input type="text" class="form-control" placeholder="CPF">
              </div>
              <div class="form-group col-md-4">
                <label>Sexo</label><br/>
                <input type="radio" /> M&nbsp;&nbsp;&nbsp;
                <input type="radio" /> F
              </div>
              <div class="form-group col-md-12">
                <label>Cidade</label>
                <input type="text" class="form-control" placeholder="Cidade">
              </div>
              <div class="form-group col-md-6">
                <label>Estado</label>
                <input type="text" class="form-control" placeholder="Estado">
              </div>
              <div class="form-group col-md-6">
                <label>País</label>
                <input type="text" class="form-control" placeholder="País">
              </div>
            </fieldset>

            <fieldset>
              <legend>Dados de Acesso ao Sistema</legend>
              <div class="form-group col-md-12">
                <label for="email-cad">E-mail</label>
                <input type="email" class="form-control" id="email-cad" placeholder="E-mail">
              </div>
              <div class="form-group col-md-12">
                <label for="senha-cad">Senha</label>
                <input type="password" class="form-control" id="senha-cad" placeholder="Senha">
              </div>
              <div class="form-group col-md-12">
                <label for="repsenha-cad">Repita sua senha</label>
                <input type="password" class="form-control" id="repsenha-cad" placeholder="Senha">
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
