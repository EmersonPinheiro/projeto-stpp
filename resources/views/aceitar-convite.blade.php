@extends('master')
@section('title', 'Aceitar convite')

@section('content')

<h2>Olá {!! $convite->nome !!} {!! $convite->sobrenome !!}</h2>
<p>Você foi convidado a ser avaliador de uma proposta de publicação da Editora UEPG!</p>

<p><strong>Título: </strong> {!! $obra->titulo !!}</p>
<p><strong>Subtítulo: </strong> {!! $obra->subtitulo !!}</p>
<p><strong>Número de páginas: {!! $convite->numPaginas !!}</strong></p> <!--TODO: Arrumar o número de páginas. Colocar o número na tabela de convite -->
<p><strong>Resumo: </strong> {!! $obra->resumo !!}</p>

<a href="{!! action('ConviteController@accept', $convite->token) !!}">Aceitar</a>
<a href="{!! action('ConviteController@reject', $convite->token) !!}">Rejeitar</a>

@endsection
