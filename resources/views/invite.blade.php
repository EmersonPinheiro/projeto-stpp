@extends('master')
@section('title', 'Contato')

@section('content')
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="quadro">
          <!-- INSERIR LINK -->
          <a href=""><span class="glyphicon glyphicon-menu-left"></span>Voltar para Proposta</a>

          <!-- TÍTULO -->
          <h3><span class="glyphicon glyphicon-user glyphicon-space"></span>Convidar Avaliador</h3>

          @if (!$errors->isEmpty())
            <!-- ERRO -->
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <p><span class="glyphicon glyphicon-exclamation-sign glyphicon-space"></span>
              Ops! Algo deu errado.</p>
              <p>Preencha corretamente o formulário abaixo convidar um avaliador para a proposta.</p>
            </div>
          @else
            <!-- INFORMAÇÕES -->
            <div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <span class="glyphicon glyphicon-info-sign glyphicon-space" aria-hidden="true"></span>
              Preencha o formulário abaixo para convidar um avaliador para a proposta. O convite será enviado para o endereço de e-mail informado.
            </div>
          @endif

          <!-- STATUS -->
          @if (session('status'))
              <div class="alert alert-info">
                  {{ session('status') }}
              </div>
          @endif

          <form method="post">
            {{ csrf_field() }}
            <input type="hidden" id="proposta" name="proposta" value="{{ $codProposta }}">
            <div class="row">
              <div class="col-md-12 form-group">
                <label for="email">E-mail do Avaliador</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{old('email')}}"/>
                <label for="nome">Nome do Avaliador</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{old('nome')}}"/>
                <label for="sobrenome">Sobrenome do Avaliador</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome" value="{{old('sobrenome')}}"/>
              </div>
            </div>
            <button class="btn btn-primary" type="submit">Convidar Avaliador</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
