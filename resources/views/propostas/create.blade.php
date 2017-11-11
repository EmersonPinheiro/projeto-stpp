@extends('master')
@section('title', 'Enviar proposta')

@section('content')
<!-- CONTENT -->
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="quadro-painel painel-info-proposta">
          <div class="panel panel-default">
            <!-- CABEÇALHO PAINEL -->
            <div class="panel-heading">
              <span class="panel-title"><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;&nbsp;&nbsp;Submissão de Proposta</span>
            </div>

            <div class="panel-body text-justify">
              <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel da Propostas</a>
              <!--FORMULÁRIO-->
              <form method="post" enctype="multipart/form-data">

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <!--PROPOSTA-->
                <fieldset>
                  <legend>Informações da Obra</legend>
                  <div class="form-group col-md-6">
                    <label>Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="{{old('titulo')}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Subtítulo</label>
                    <input type="text" class="form-control" id="subtitulo" name="subtitulo" placeholder="Subtítulo" value="{{old('subtitulo')}}">
                  </div>
                  <div class="form-group col-md-12">
                    <label>Descrição</label>
                    <textarea type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{old('descricao')}}"></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label>Resumo</label>
                    <textarea type="text" class="form-control" id="resumo" name="resumo" placeholder="Resumo" value="{{old('resumo')}}"></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label>Palavras-chave</label>
                    <textarea type="text" class="form-control" id="palavra" name="palavra" placeholder="Palavras chave" value="{{old('titulo')}}"></textarea>
                  </div>
                </fieldset>


                <!--AUTOR/PESSOA-->
                <fieldset>
                  <legend>Informações Pessoais do Autor</legend>
                  <div class="form-group col-md-4">
                    <label>Nome</label>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="{!! $autor->nome !!}">
                  </div>
                  <div class="form-group col-md-8">
                    <label>Sobrenome</label>
                    <input type="text" id="sobrenome" name="sobrenome" class="form-control" placeholder="Sobrenome" value="{!! $autor->sobrenome !!}">
                  </div>
                  <div class="form-group col-md-6">
                    <label>CPF</label>
                    <input type="text" id="CPF" name="CPF" class="form-control" placeholder="CPF" value="{!! $autor->cpf !!}">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Sexo</label><br/>

                    <!--VERIFICAR RECUPERAÇÃO DO VALOR ANTIGO EM CASO DE ERRO NO CADASTRO-->
                    <input type="radio" name="sexo" value="M"/> M&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="sexo" value="F"/> F
                  </div>
                </fieldset>

                <!--INSTITUIÇÃO/DEPARTAMENTO/SETOR...-->
                <fieldset>
                  <legend>Informações Profissionais do Autor</legend>
                  <div class="form-group col-md-4">
                    <label>Instituição</label>
                    <input type="text" id="instituicao" name="instituicao" class="form-control" placeholder="Instituição" value="{{old('instituicao')}}">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Setor</label>
                    <input type="text" id="setor" name="setor" class="form-control" placeholder="Setor" value="{{old('setor')}}">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Departamento</label>
                    <input type="text" id="departamento" name="departamento" class="form-control" placeholder="Departamento" value="{{old('departamento')}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Grande Área</label>
                    <input type="text" id="grande_area" name="grande_area" class="form-control" placeholder="Grande Área" value="{{old('grande_area')}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Área de Conhecimento</label>
                    <input type="text" id="area_de_conhecimento" name="area_de_conhecimento" class="form-control" placeholder="Área de Conhecimento" value="{{old('area_de_conhecimento')}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Subárea</label>
                    <input type="text" id="subarea" name="subarea" class="form-control" placeholder="Subárea" value="{{old('subarea')}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Especialidade</label>
                    <input type="text" id="especialidade" name="especialidade" class="form-control" placeholder="Especialidade" value="{{old('especialidade')}}">
                  </div>
                </fieldset>

                <!--CONTATO-->
                <fieldset>
                  <legend>Informações de Contato do Autor</legend>
                  <div class="form-group col-md-6">
                    <label>E-mail</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="E-mail" value="{{old('email')}}">
                  </div>
                  <div class="form-group col-md-6">
                    <label>Telefone</label>
                    <input type="text" id="telefone" name="telefone" class="form-control" placeholder="Telefone" value="{{old('telefone')}}">
                  </div>

                  <!--LOCALIDADE-->
                  <div class="form-group col-md-4">
                    <label>Cidade</label>
                    <input type="text" id="cidade" name="cidade" class="form-control" placeholder="Cidade" value="{{old('cidade')}}">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Estado</label>
                    <input type="text" id="estado" name="estado" class="form-control" placeholder="Estado" value="{{old('estado')}}">
                  </div>
                  <div class="form-group col-md-4">
                    <label>País</label>
                    <input type="text" id="pais" name="pais" class="form-control" placeholder="País" value="{{old('pais')}}">
                  </div>
                </fieldset>

                <!--ARQUIVOS-->
                <fieldset>
                  <legend>Arquivos</legend>
                  <div class="form-group col-md-6">
                    <label>Documento (.doc ou .docx)</label>
                    <input type="file" id="documento" name="documento" class="form-control">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="cad7">Imagens (.rar ou .zip)</label>
                    <input type="file" id="imagens" name="imagens" class="form-control">
                  </div>
                </fieldset>
                <hr>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" style="width:30%;">Submeter proposta</button>
                </div>
              </form>
            </div>
            <div class="panel-footer">
              <a href="/propostas"><span class="glyphicon glyphicon-menu-left"></span> Voltar para o Painel das Propostas</a>
            </div>
          </div> <!-- painel -->
        </div> <!-- /quadro-painel /painel-info-propostas -->
      </div>
    </div>
  </div> <!--container -->
</div> <!-- content -->
@endsection
