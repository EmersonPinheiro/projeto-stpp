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
            <p>O Sistema de Submissão de Propostas foi desenvolvido para autores de livros acadêmicos que desejam publicar suas obras com a Editora UEPG. Seu objetivo é facilitar o trâmite de documentos entre as partes e permitir que o autor acompanhe a situação de sua proposta a cada etapa do processo.</p>
            <p>Considerando seu compromisso com a consolidação e divulgação do conhecimento, a Editora UEPG recebe proposta de obras - livros para avaliação com vistas à publicação, em fluxo contínuo.</p>
            <p>A política editorial está voltada para a publicação de obras acadêmicas que possam ser utilizadas por estudantes da graduação, pós-graduação e comunidade em geral, refletindo a experiência e trajetória universitária em docência, pesquisas científicas e conhecimento produzido a partir da extensão.  A Editora UEPG publica livros universitários que se constituem em obras de caráter científico voltadas para o debate acadêmico e difusão de conhecimento.</p>
            <p>Para mais informações de como utilizar o sistema, acesse a guia Ajuda na barra superior da página.</p>
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
            <img src="{{ asset('img/editora_uepg.png') }}" style="margin-top:50px;" class="img-responsive center-block logo-editora" alt="Responsive image" width="230" />
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
