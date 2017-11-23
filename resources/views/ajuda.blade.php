@extends('master')
@section('title', 'Ajuda')

@section('content')
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="quadro ajuda text-justify">
          <h3><span class="glyphicon glyphicon-question-sign glyphicon-space"></span><strong>Ajuda</strong></h3>
          <h4 class="titulo">Informações Gerais</h4>
          <ol>
            <li>Na barra superior sempre serão exibidos os links de contato com a Editora UEPG, de Ajuda e da página do Catálogo da Editora UEPG (link externo).</li>
            <li>Em vários elementos do sistema é exibido um ícone de um círculo azul com um ponto de interrogação no centro. Clique neste ícone para abrir uma caixa de ajuda com informações adicionais úteis ao usuário.</li>
            <li>Todos os campos dos formulários do sistema possuem um sistema de validação que verifica se um campo obrigatório não é preenchido ou se é preenchido incorretamente. Caso algum valor seja inválido o sistema notificará o usuário que poderá corrigí-lo.</li>
          </ol>

          <h4 class="titulo">Propositor</h4>
          <p>O autor que deseja publicar sua obra com a Editora UEPG deve seguir os seguintes passos para realizar a submissão:</p>
          <ol>
            <li>A Página Inicial contém uma breve descrição do sistema e uma apresentação da Editora UEPG, além do formulário de login e do botão de cadastro.</li>
            <li>Caso seja a primeira vez que esteja utilizando o sistema, o Propositor deverá cadastrar-se clicando no botão azul “Cadastrar-se” logo abaixo do formulário de Login na página inicial.</li>
            <li>Ao ser direcionado para a página de cadastro, o propositor deverá informar seus dados pessoais, institucionais e de contato, bem como o endereço de e-mail e a senha que deseja utilizar para acessar o sistema.</li>
            <li>Tendo feito seu cadastro, o Propositor receberá um link de confirmação em seu e-mail, através do qual poderá acessar o sistema inserindo seus dados no formulário de Login da página inicial.</li>
            <li>Ao fazer login, o sistema o direcionará para o Painel onde ficarão as propostas por ele cadastradas. Caso ainda não hajam propostas, o painel exibirá uma mensagem para que o Propositor submeta sua proposta de publicação. Ao lado do painel de propostas será exibido outro painel com as notificações que o sistema envia para o Propositor quando determinadas ações são executadas.</li>
            <li>Ao clicar em Submeter Nova Proposta o Propositor é direcionado para um formulário de submissão. Ele deve preencher este formulário com os dados da obra, sua categoria de autor, bem como os arquivos da mesma, com e sem identificação. Também é possível adicionar um arquivo compactado com as imagens da obra. Note que os dados do Propositor são copiados para o do Autor. Caso queira alterar algum destes dados, o Propositor poderá fazê-lo na guia Perfil localizada na barra superior.</li>
            <li>Não havendo erros na submissão e tendo aceito o Termos de Uso do Sistema, a proposta deverá aparecer no topo do painel do Propositor exibindo seu título, subtítulo (se houver), resumo, data de submissão e a situação, que nesta etapa deve estar como submetida.</li>
            <li>No cabeçalho da proposta há um link de Mais Informações. Ao clicar neste link, o Propositor será direcionado para a página que contém todas as informações cadastradas da proposta, incluindo arquivos e informações adicionais que poderão ser cadastradas pelo Administrador do sistema nas etapas seguintes do trâmite.</li>
            <li>Dentre os arquivos, existem o Documento de Sugestão de Alterações, que será submetido pelo Administrador após a obra ser avaliada e que deverá conter sugestões de alterações que o Propositor deverá fazer em sua proposta, e o Ofício de Alterações, que deverá ser submetido pelo Propositor clicando no botão Enviar Nova Versão da Obra juntamente com versões alteradas dos arquivos conforme sugerido pelo Administrador. Caso estes arquivos não tenham sido submetidos, uma mensagem deverá</li> ser exibida para o Propositor.
            <li> O rodapé da página ainda contém os botões de Editar Proposta e Solicitar Cancelamento da Proposta. O cancelamento só poderá ser solicitado caso ainda não tenha sido firmado um contrato com a Editora UEPG.</li>
          </ol>

          <h4 class="titulo">Administrador</h4>
          <ol>
            <li>O Administrador que já se encontra cadastrado no sistema deverá fazer seu login normalmente através do formulário da página inicial.</li>
            <li>Ao acessar o sistema, ele será direcionado para um painel onde poderá visualizar todas as propostas em trâmite no sistema. Caso não hajam propostas cadastradas, o painel exibirá uma mensagem informando o mesmo. Ao lado do painel de propostas será exibido outro painel com as notificações que o sistema envia para o Administrador quando determinadas ações são executadas.</li>
            <li>As propostas serão listadas da mais recente para a mais antiga (quanto à data de submissão). Nas propostas são exibidos título, subtítulo (se houver), resumo, data de submissão e a situação atual da mesma.</li>
            <li>No cabeçalho da proposta há um link de Mais Informações. Ao clicar neste link, o Administrador será direcionado para a página que contém todas as informações cadastradas da proposta, incluindo arquivos e informações adicionais que poderão ser cadastradas pelo Administrador nas etapas seguintes do trâmite.</li>
            <li>Nesta página, o Administrador terá acesso a todos os arquivos enviados pelo Propositor, por ele mesmo e aos pareceres enviados pelos Pareceristas (avaliadores) da proposta.</li>
            <li>Para convidar um Professor a ser Parecerista de uma proposta de publicação, o Administrador deverá clicar no botão Convidar Avaliador que o direcionará para um formulário no qual ele deve informar o e-mail, nome, sobrenome, o arquivo em pdf da obra original modificada pela Editora e o número de páginas deste arquivo. O convite tem um formato padrão e é enviado para o e-mail informado neste formulário. Se o Parecerista aceitar o convite (cadastrando-se no sistema) o Administrador</li> será notificado e o paracer por ele enviado será exibido na página de informações da obra (somente para o Administrador).
            <li>A partir dos pareceres recebidos, o conselho editorial organizará o Documento de Sugestão de Alterações que deverá ser submetido no sistema pelo Administrador clicando sobre o botão Solicitar Nova Versão da Obra.</li>
            <li>O Administrador poderá ainda editar a proposta clicando sobre o botão Editar Proposta no inferior da página e alterar a situação da proposta na página para a qual ele é direcionado. Também no inferior da página encontram-se os botões Gerar Relatório e Cancelar Proposta.</li>
          </ol>

          <h4 class="titulo">Parecerista</h4>
          <ol>
            <li>Para tornar-se um Parecerista (avaliador) de uma proposta, a pessoa deve ser convidada por e-mail pelo Administrador do sistema. Os pareceristas são escolhidos ad hoc da Editora UEPG.</li>
            <li>Para aceitar o convite, a pessoa deverá clicar no link do e-mail que o direcionará para uma página de cadastro do sistema. Ao cadastrar-se ela torna-se Parecerista e uma notificação é enviada para o Administrador.</li>
            <li>Ao fazer login o Parecerista será direcionado para o painel das propostas as quais ele está vinculado como avaliador. Ao lado do painel de propostas será exibido outro painel com as notificações que o sistema envia para o Parecerista quando determinadas ações são executadas.</li>
            <li>No cabeçalho da proposta é exibido o prazo que o Parecerista tem para enviar seu parecer e um link que o direcionará para uma página de informações sobre a proposta na qual ele terá acesso ao arquivo pdf submetido pelo administrador e também na qual ele poderá submeter seu parecer preenchendo o formulário indicado.</li>
            <li>Feita a submissão, o prazo deixa de aparecer e o Administrador do sistema é notificado.</li>
          </ol>

          <h4 id="genese-relevancia" class="titulo">Gênese e Relevância</h4>
          <ul>
            <li>Explicitação dos processos que originaram a proposta de publicação (pesquisa, congresso, dissertação, tese ou produção artístico-cultural) </li>
            <li>Explicitação de processos anteriores de avaliação a que a obra tenha sido eventualmente submetida.</li>
            <li>Indicação de obras similares (que tratam do mesmo tema, complemento) ou dos motivos que conferem originalidade à obra.</li>
            <li>Apresentação de argumentos que validem a importância da publicação.</li>
            <li>Público-alvo.</li>
          </ul>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
