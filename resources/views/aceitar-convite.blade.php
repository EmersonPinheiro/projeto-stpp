@extends('master')
@section('title', 'Aceitar convite')

@section('content')
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="quadro text-center">

          <h3><strong>Prezado(a) Dr(a). {!! $convite->nome !!} {!! $convite->sobrenome !!}</strong></h3>
          <p>Você foi convidado a ser avaliador de uma proposta de publicação da Editora UEPG!</p>
          <hr>
          <p><strong>Título: </strong> {!! $obra->titulo !!}</p>
          <p><strong>Subtítulo: </strong> {!! $obra->subtitulo !!}</p>
          <p><strong>Número de páginas: {!! $convite->numPaginas !!}</strong></p> <!--TODO: Arrumar o número de páginas. Colocar o número na tabela de convite -->
          <p><strong>Resumo: </strong> {!! $obra->resumo !!}</p>
          <hr>
          <p class="alert alert-info">Ao aceitar o convite, você terá acesso ao material da proposta para avaliá-la e uma notificação será enviada ao Administradordo sistema.</p>
          <a class="btn btn-success" href="{!! action('ConviteController@accept', $convite->token) !!}">Aceitar</a>
          <a class="btn btn-danger"href="{!! action('ConviteController@reject', $convite->token) !!}">Recusar</a>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
