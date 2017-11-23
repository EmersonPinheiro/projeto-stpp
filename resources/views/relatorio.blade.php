@extends('master')
@section('title', 'Relatório')

@section('content')
<!-- CONTENT -->

<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="quadro-painel painel-info-proposta">
          <div class="panel panel-default">


            @foreach($notificacoesProposta as $notificacao)
              {{$notificacao->message_report}} {{$notificacao->created_at}} <br>
            @endforeach

            <!--<a class="btn btn-primary" href="" role="button"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp;Imprimir</a>-->
          </div> <!-- painel -->
        </div> <!-- /quadro-painel /painel-info-propostas -->
      </div> <!-- /col -->
    </div> <!-- /row -->
  </div> <!-- /container -->
</div> <!-- /content -->
@endsection
