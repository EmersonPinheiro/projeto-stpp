@extends('master')
@section('title', 'Perfil')

@section('content')
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="quadro">

          <div class="row">
            <div class="col-md-8">
              <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>
            </div>
            <div class="col-md-4">
              <div class="pull-right">
                <a class="btn btn-primary" href="{!! action('PerfilController@edit', $pessoaUsuario->slug) !!}" role="button"><span class="glyphicon glyphicon-pencil glyphicon-space"></span>Editar Perfil</a>
              </div>
            </div>
          </div>

          <h3><span class="glyphicon glyphicon-user glyphicon-space"></span><strong>Perfil de {!! $pessoaUsuario->nome !!} {!! $pessoaUsuario->sobrenome !!}</strong></h3>

          <div class="row">
            <div class="col-md-6">
              <h4 class="titulo">Dados Pessoais e Institucionais</h4>
              <table class="table table-striped">
                <tr>
                  <td><strong>Nome: </strong></td>
                  <td> {!! $pessoaUsuario->nome !!} </td>
                </tr>
                <tr>
                  <td><strong>Sobrenome: </strong></td>
                  <td> {!! $pessoaUsuario->sobrenome !!} </td>
                </tr>
                <tr>
                  <td><strong>Sexo: </strong></td>
                  <td> {!! $pessoaUsuario->sexo !!} </td>
                </tr>
                <tr>
                  <td><strong>CPF: </strong></td>
                  <td> {!! $pessoaUsuario->cpf !!} </td>
                </tr>
                <tr>
                  <td><strong>RG: </strong></td>
                  <td> {!! $pessoaUsuario->rg !!} </td>
                </tr>
                <tr>
                  <td><strong>Estado Civil: </strong></td>
                  <td> {!! $pessoaUsuario->estado_civil !!} </td>
                </tr>
                @if(!$usuarioLogado->hasRole('admin'))
                  <tr>
                    <td><strong>Instituicao: </strong></td>
                    <td> {!! $instituicaoVinculo->nome_instituicao !!} @if($instituicaoVinculo->sigla != null) - {!! $instituicaoVinculo->sigla !!} @endif</td>
                  </tr>
                  <tr>
                    <td><strong>Vínculo Institucional: </strong></td>
                    <td> {!! $instituicaoVinculo->nome_vinculo !!} </td>
                  </tr>

                  @if($usuarioTipo->hasRole('parecerista'))
                    <tr>
                      <td><strong>Grande Area: </strong></td>
                      <td> {!! $areasConhecimento->nome_grande_area !!} </td>
                    </tr>
                    <tr>
                      <td><strong>Area de conhecimento: </strong></td>
                      <td> {!! $areasConhecimento->nome_area_conhecimento !!} </td>
                    </tr>

                      @if($areasConhecimento->nome_subarea != null)
                        <tr>
                          <td><strong>Subarea: </strong></td>
                          <td> {!! $areasConhecimento->nome_subarea !!} </td>
                        </tr>
                      <tr>
                        <td><strong>Especialidade: </strong></td>
                        <td> {!! $areasConhecimento->nome_especialidade !!} </td>
                      </tr>
                      @endif
                  @endif
              </table>
            </div>

            <div class="col-md-6">
              <h4 class="titulo">Dados de Contato</h4>
              <table class="table table-striped">
                <tr>
                  <td><strong>Logradouro: </strong></td>
                  <td> {!! $pessoaUsuario->logradouro !!} </td>
                </tr>
                <tr>
                  <td><strong>Bairro: </strong></td>
                  <td> {!! $pessoaUsuario->bairro !!} </td>
                </tr>
                <tr>
                  <td><strong>Cidade: </strong></td>
                  <td> {!! $localizacao->nome_cidade !!} </td>
                </tr>
                <tr>
                  <td><strong>Estado: </strong></td>
                  <td> {!! $localizacao->nome_estado_provincia !!} </td>
                </tr>
                <tr>
                  <td><strong>País: </strong></td>
                  <td> {!! $localizacao->nome_pais !!} </td>
                </tr>
                <tr>
                  <td><strong>CEP: </strong></td>
                  <td> {!! $pessoaUsuario->CEP !!} </td>
                </tr>
                <tr>
                  <td><strong>Telefone: </strong></td>
                  <td> {!! $telefone->numero !!} </td>
                </tr>
                <tr>
                  <td><strong>Telefone Secundário: </strong></td>
                  <td>  </td>
                </tr>
                <tr>
                  <td><strong>E-mail: </strong></td>
                  <td> {!! $email->endereco !!} </td>
                </tr>
                <tr>
                  <td><strong>E-mail Secundário: </strong></td>
                  <td>  </td>
                </tr>
                @endif
              </table>
            </div>
          </div>

          @if($usuarioLogado->email == $pessoaUsuario->email  )
          <div class="row">
            <div class="col-md-12">
              <h4 class="titulo">Dados de Acesso ao Sistema</h4>
              <table class="table table-striped">
                <tr>
                  <td><strong>E-mail: </strong></td>
                  <td> {!! $pessoaUsuario->email !!} </td>
                  <td><strong>Senha: </strong></td>
                  <td >
                    <a class="btn btn-primary" href="" role="button"><span class="glyphicon glyphicon-lock glyphicon-space"></span>Alterar sua Senha</a>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          @endif
        </div> <!-- quadro -->
      </div>
    </div>
  </div>
</div>
@endsection
