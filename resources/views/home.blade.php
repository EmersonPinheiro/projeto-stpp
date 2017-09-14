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
          </div> <!-- info -->
        </div> <!-- quadro-info -->
      </div> <!-- col -->

      <!-- ACESSO AO SISTEMA -->
      <div class="col-md-4">
        <div class="quadro-login">

          <!-- FORMULÁRIOS -->
          <div class="quadro-form-login">
            <!-- LOGIN -->
            <div role="tabpanel" class="tab-pane active" id="login">
              <form action="painel-autor.html">
                <div class="form-group">
                  <label for="email-login">E-mail</label>
                  <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                    <input type="email" class="form-control" id="email-login" placeholder="E-mail">
                  </div>
                </div>
                <div class="form-group">
                  <label for="senha-login">Senha</label>
                  <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                    <input type="password" class="form-control" id="senha-login" placeholder="Senha">
                  </div>
                </div>
                <p class="text-right"><a href="">Esqueceu sua senha?</a></p>
                <button type="submit" class="btn btn-success btn-block">Entrar</button>
              </form>
            </div>
          </div> <!-- quadro-form -->
        </div> <!-- quadro-login -->
      </div> <!-- col -->
    </div> <!-- row -->

    <!-- PASSOS -->
    <div class="row">
      <div class="col-md-3">
        <div class="quadro quadro-passos">
          <h4 class="titulo">Passo 1</h4>
          <!--<img src="curriculum.png" class="img-responsive center-block" alt="responsive image" width="80" />-->
          <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident explicabo corporis neque veniam hic quaerat.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="quadro quadro-passos">
          <h4 class="titulo">Passo 2</h4>
          <!--<img src="upload.png" class="img-responsive center-block" alt="responsive image" width="80" />-->
          <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident explicabo corporis neque veniam hic quaerat.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="quadro quadro-passos">
          <h4 class="titulo">Passo 3</h4>
          <!--<img src="team.png" class="img-responsive center-block" alt="responsive image" width="80" />-->
          <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident explicabo corporis neque veniam hic quaerat.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="quadro quadro-passos">
          <h4 class="titulo">Passo 4</h4>
          <!--<img src="book.png" class="img-responsive center-block" alt="responsive image" width="80" />-->
          <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident explicabo corporis neque veniam hic quaerat.</p>
        </div>
      </div>
    </div> <!-- row -->
  </div> <!--container -->
</div> <!-- content -->
@endsection
