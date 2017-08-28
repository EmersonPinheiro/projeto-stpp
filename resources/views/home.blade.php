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

          <!-- ABAS DE LOGIN E CADASTRO -->
          <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#login" data-toggle="tab">Login</a></li>
            <li><a href="#cadastro" data-toggle="tab">Cadastro</a></li>
          </ul>

          <!-- FORMULÁRIOS -->
          <div class="quadro-form-login">
            <div class="tab-content">

              <!-- LOGIN -->
              <div class="tab-pane active" id="login">
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

              <!-- CADASTRO -->
              <div class="tab-pane" id="cadastro">
                <form action="">

                  <div class="form-group col-md-12">
                    <label>Nome</label>
                    <input type="text" class="form-control" placeholder="Nome">
                  </div>
                  <div class="form-group col-md-12">
                    <label>Sobrenome</label>
                    <input type="text" class="form-control" placeholder="Sobrenome">
                  </div>
                  <div class="form-group col-md-8">
                    <label>CPF</label>
                    <input type="text" class="form-control" placeholder="CPF">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Sexo</label><br/>
                    <input type="radio" /> M&nbsp;&nbsp;&nbsp;
                    <input type="radio" /> F
                  </div>
                  <div class="form-group col-md-12">
                    <label>Cidade</label>
                    <input type="text" class="form-control" placeholder="Cidade">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Estado</label>
                    <input type="text" class="form-control" placeholder="Estado">
                  </div>
                  <div class="form-group col-md-6">
                    <label>País</label>
                    <input type="text" class="form-control" placeholder="País">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="email-cad">E-mail</label>
                    <input type="email" class="form-control" id="email-cad" placeholder="E-mail">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="senha-cad">Senha</label>
                    <input type="password" class="form-control" id="senha-cad" placeholder="Senha">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="repsenha-cad">Repita sua senha</label>
                    <input type="password" class="form-control" id="repsenha-cad" placeholder="Senha">
                  </div>
                  <button type="submit" class="btn btn-primary btn-block">Cadastro</button>
                </form>
              </div>
            </div> <!-- tab-content -->
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
