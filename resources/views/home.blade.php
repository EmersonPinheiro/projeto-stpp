@extends('master')
@section('title', 'Home')

@section('content')
<!-- CONTENT -->
  <div class="content">
    <div class="container">
      <div class="row">
        <!-- INFORMAÇÕES -->
        <div class="col-md-8">
          <div class="quadro-info text-justify">
            <h3><strong>Como funciona o sistema de submissão?</strong></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div> <!-- quadro-info -->
        </div> <!-- col -->

        <!-- ACESSO AO SISTEMA -->
        <div class="col-md-4">
          <div class="quadro-login">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @include('formLogin')

          </div> <!-- quadro-login -->
        </div> <!-- col -->
      </div> <!-- row -->
      <div class="quadro-editora">
        <div class="row">
          <div class="col-md-4">
            <img src="{{ asset('img/editora_uepg.png') }}" class="img-responsive center-block" alt="Responsive image" width="230" />
          </div>
          <div class="col-md-8 text-justify">
            <h4><strong>A Editora UEPG</strong></h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
        </div>
      </div>
    </div> <!--container -->
  </div> <!-- content -->
@endsection
