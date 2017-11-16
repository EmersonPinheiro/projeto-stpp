@extends('master')
@section('title', 'Contato')

@section('content')
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="quadro">
          <h4>O que deseja Fazer?</h4>
          <div class="row">
            <div class="col-md-12">
              <a href="/propostas" class="btn btn-primary"><span class="glyphicon glyphicon-book glyphicon-space"></span>Acessar suas Propostas</a>
              <a href="/painel-parecerista" class="btn btn-primary"><span class="glyphicon glyphicon-star glyphicon-space"></span>Avaliar Propostas</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
