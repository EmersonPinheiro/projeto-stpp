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

            @include('formLogin')

          </div> <!-- quadro-login -->
        </div> <!-- col -->
      </div> <!-- row -->
      <div class="quadro-editora">
        <div class="row">
          <div class="col-md-4">
            <img src="{{ asset('img/editora_uepg.png') }}" class="img-responsive center-block logo-editora" alt="Responsive image" width="230" />
          </div>
          <div class="col-md-8 text-justify">
            <h4><strong>A Editora UEPG</strong></h4>
            <p>A Editora UEPG comemora 20 anos de existência – 1997-2017, consolidando-se como um importante instrumento para a divulgação do conhecimento científico e do debate acadêmico, contribuindo com a missão da Universidade Estadual de Ponta Grossa.</p>
            <p>O catálogo da Editora UEPG, com 160 livros publicados nas diversas áreas de conhecimento, expressa a sua perspectiva democrática e plural no debate científico. As publicações da Editora UEPG passam por rigorosa análise, contando com a colaboração de pesquisadores como pareceristas ad hoc e pela deliberação de seu Conselho Editorial, assegurando a qualidade acadêmica de suas obras.</p>
            <p>A Editora UEPG assume uma postura aberta ao diálogo com a comunidade acadêmica, recebe propostas de publicações de pesquisadores de diferentes instituições de pesquisa e dos programas de pós-graduação do país.</p>
          </div>
        </div>
      </div>
    </div> <!--container -->
  </div> <!-- content -->
@endsection
