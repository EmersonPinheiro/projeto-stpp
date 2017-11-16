@extends('master')
@section('title', 'Contato')

@section('content')
<form method="post">
    {{ csrf_field() }}
    <input type="email" name="email" />
    <input type="hidden" id="proposta" name="proposta" value="{{ $codProposta }}">
    <button type="submit">Convidar parecerista</button>
</form>
@endsection
