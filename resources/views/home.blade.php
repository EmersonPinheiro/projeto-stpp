@extends('master')
@section('title', 'Home')

@section('content')
<!-- CONTENT -->
  <div class="content">
    <div class="container">
      <div class="row">
        <!-- INFORMAÇÕES -->
        <div class="col-md-8">
          <div class="quadro-info">
            <div class="info text-justify">
              <h3>Como funciona o sistema de submissão?</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi officia, iure ducimus nulla. Pariatur mollitia, consequatur iusto minus, tenetur non corporis reiciendis vitae aliquam esse illo iste eaque architecto. Itaque.</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi officia, iure ducimus nulla. Pariatur mollitia, consequatur iusto minus, tenetur non corporis reiciendis vitae aliquam esse illo iste eaque architecto. Itaque.</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi officia, iure ducimus nulla. Pariatur mollitia, consequatur iusto minus, tenetur non corporis reiciendis vitae aliquam esse illo iste eaque architecto. Itaque.</p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi officia, iure ducimus nulla. Pariatur mollitia, consequatur iusto minus, tenetur non corporis reiciendis vitae aliquam esse illo iste eaque architecto. Itaque.</p>
            </div> <!-- info -->
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

            @include('auth.login')

          </div> <!-- quadro-login -->
        </div> <!-- col -->
      </div> <!-- row -->
    </div> <!--container -->
  </div> <!-- content -->
@endsection
