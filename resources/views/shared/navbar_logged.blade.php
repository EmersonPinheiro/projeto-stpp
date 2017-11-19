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

        <?php
        use App\Pessoa;
        $pessoa = Pessoa::join('Usuario', 'Pessoa.cod_pessoa', 'Usuario.Pessoa_cod_pessoa')->where('cod_usuario', '=', Auth::user()->cod_usuario)->first();
        //dd(Auth::user());
        ?>

        <li>Bem vindo {!! $pessoa->nome !!}</li>

        @role('propositor')
        <li><a href="/propostas" class="navbar-link">Suas Propostas</a></li>
        @endrole
        @role('parecerista')
        <li><a href="/painel-parecerista" class="navbar-link">Seus Pareceres</a></li>
        @endrole

        @role('admin')
        <li><a href="/admin/painel-administrador" class="navbar-link">Propostas</a></li>
        @endrole

        <li><a href="{!! action('PerfilController@show', $pessoa->slug) !!}" class="navbar-link">Perfil</a></li>
        <li><a href="/contato" class="navbar-link">Contato</a></li>
        <li><a href="/ajuda" class="navbar-link">Ajuda</a></li>
        <li><a href="http://www.uepg.br/editora/" target="_blank" class="navbar-link">Editora UEPG</a></li>
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
