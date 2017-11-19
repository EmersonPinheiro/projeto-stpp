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
                <a class="btn btn-primary" href="" role="button"><span class="glyphicon glyphicon-pencil glyphicon-space"></span>Editar Perfil</a>
              </div>
            </div>
          </div>

          <h3><span class="glyphicon glyphicon-user glyphicon-space"></span><strong>Perfil de INSERIR NOME DA PESSOA</strong></h3>

          <div class="row">
            <div class="col-md-6">
              <h4 class="titulo">Dados Pessoais e Institucionais</h4>
              <table class="table table-striped">
                <tr>
                  <td><strong>Nome: </strong></td>
                  <td> {!! $pessoa->nome !!} </td>
                </tr>
                <tr>
                  <td><strong>Sobrenome: </strong></td>
                  <td> {!! $pessoa->sobrenome !!} </td>
                </tr>
                <tr>
                  <td><strong>Sexo: </strong></td>
                  <td> {!! $pessoa->sexo !!} </td>
                </tr>
                <tr>
                  <td><strong>CPF: </strong></td>
                  <td> {!! $pessoa->cpf !!} </td>
                </tr>
                <tr>
                  <td><strong>RG: </strong></td>
                  <td> {!! $pessoa->rg !!} </td>
                </tr>
                <tr>
                  <td><strong>Estado Civil: </strong></td>
                  <td> {!! $pessoa->estado_civil !!} </td>
                </tr>
                <tr>
                  <td><strong>Instituicao: </strong></td>
                  <td>  </td>
                </tr>
                <tr>
                  <td><strong>Vínculo Institucional: </strong></td>
                  <td> INSERIR </td>
                </tr>
              </table>
            </div>

            <div class="col-md-6">
              <h4 class="titulo">Dados de Contato</h4>
              <table class="table table-striped">
                <tr>
                  <td><strong>Logradouro: </strong></td>
                  <td> {!! $pessoa->logradouro !!} </td>
                </tr>
                <tr>
                  <td><strong>Bairro: </strong></td>
                  <td> {!! $pessoa->bairro !!} </td>
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
                  <td> {!! $pessoa->CEP !!} </td>
                </tr>
                <tr>
                  <td><strong>Telefone: </strong></td>
                  <td> INSERIR </td>
                </tr>
                <tr>
                  <td><strong>Telefone Secundário: </strong></td>
                  <td> INSERIR </td>
                </tr>
                <tr>
                  <td><strong>E-mail Secundário: </strong></td>
                  <td> INSERIR </td>
                </tr>
              </table>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <h4 class="titulo">Dados de Acesso ao Sistema</h4>
              <table class="table table-striped">
                <tr>
                  <td><strong>E-mail: </strong></td>
                  <td> INSERIR </td>
                  <td><strong>Senha: </strong></td>
                  <td >
                    <a class="btn btn-primary" href="" role="button"><span class="glyphicon glyphicon-lock glyphicon-space"></span>Alterar sua Senha</a>
                  </td>
                </tr>
              </table>
            </div>
          </div>

        </div> <!-- quadro -->
      </div>
    </div>
  </div>
</div>
@endsection
