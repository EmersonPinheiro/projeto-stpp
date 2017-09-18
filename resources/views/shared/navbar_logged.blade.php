<!-- NAVBAR -->
<nav class="navbar navbar-outro navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">
        Editora UEPG
        <!-- <img src="editora_uepg.png" alt="Brand" width="110"/> -->
      </a>
      <p class="navbar-text desc">Sistema de Submissão </br/>Online de Propostas</p>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/painel" class="navbar-link">Painel</a></li>
        <li><a href="#" class="navbar-link">Perfil</a></li>
        <li><a href="/contato" class="navbar-link">Contato</a></li>
        <li><a href="#" class="navbar-link">Editora UEPG</a></li>
        <li><a href="/ajuda" class="navbar-link">Ajuda</a></li>
        @if (Auth::check())
        <li>
          <form class=" navbar-link" id="logout-form" action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
            <input class="btn btn-link" role="link" type="submit" name="logout" value="Sair">
          </form>
        </li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
