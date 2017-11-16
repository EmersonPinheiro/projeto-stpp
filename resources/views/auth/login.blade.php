@extends('master')
@section('title', 'Login')

@section('content')
<!-- CONTENT -->
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="quadro-login">
            @include('formLogin')
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
