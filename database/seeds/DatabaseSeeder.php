<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('PaisTableSeeder');
        $this->call('PalavaChaveTableSeeder');
        $this->call('GrandeAreaTableSeeder');
        $this->call('InstituicaoTableSeeder');
        $this->call('EstadoProvinciaTableSeeder');
        $this->call('SetorTableSeeder');
        $this->call('Area_ConhecimentoTableSeeder');
        $this->call('CidadeTableSeeder');
        $this->call('SubareaTableSeeder');
        $this->call('DepartamentoTableSeeder');
        $this->call('PessoaTableSeeder');
        $this->call('EspecialidadeTableSeeder');
        $this->call('AutorTableSeeder');
        $this->call('EmailTableSeeder');
        $this->call('TecnicoCatalografiaTableSeeder');
        $this->call('TelefoneTableSeeder');
        $this->call('UsuarioTableSeeder');
        $this->call('AutorEspecialidadeTableSeeder');
        $this->call('UsuarioPropositorTableSeeder');
        $this->call('UsuarioPareceristaTableSeeder');
        $this->call('UsuarioAdmTableSeeder');
        $this->call('PropostaTableSeeder');
        $this->call('UsuarioPareceristaEspecialidadeTableSeeder');
        $this->call('OficioAlteracoesTableSeeder');
        $this->call('DocSugAltTableSeeder');
        $this->call('NotificacaoTableSeeder');
        $this->call('ParecerTableSeeder');
        $this->call('ObraTableSeeder');
        $this->call('PropTecCatTableSeeder');
        $this->call('MaterialTableSeeder');
        $this->call('ObraPalavrasChaveTableSeeder');
    }
}

class PaisTableSeeder extends Seeder
{

    public function run()
    {
      DB::table('Pais')->delete();

      DB::table('Pais')->insert([
            'nome' => 'Brasil',
        ]);
    }
}

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            'name'=>'asdfasfaf',
            'email'=>'asdfadf@gmail.com',
            'password'=>bcrypt('123456'),
        ]);
    }
}

class PalavaChaveTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Palavras_Chave')->delete();

        DB::table('Palavras_Chave')->insert([
            'palavra'=>'Funcoes',
        ]);
    }
}

class GrandeAreaTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Grande_Area')->delete();

        DB::table('Grande_Area')->insert([
            'nome'=>'Matematica',
        ]);
    }
}

class InstituicaoTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Instituicao')->delete();

        DB::table('Instituicao')->insert([
            'nome'=>'Universidade Estadual de Ponta Grossa',
        ]);
    }
}

class EstadoProvinciaTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Estado_provincia')->delete();

        DB::table('Estado_provincia')->insert([
            'sigla'=>'PR',
            'nome'=>'Parana',
            'Pais_cod_pais'=>'1',
        ]);
    }
}

class SetorTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Setor')->delete();

        DB::table('Setor')->insert([
            'nome'=>'Setor de ciencias agrarias e de tecnologia',
            'Instituicao_cod_instituicao'=>'1',
        ]);
    }
}

class Area_ConhecimentoTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Area_Conhecimento')->delete();

        DB::table('Area_Conhecimento')->insert([
            'nome'=>'Funcoes matematicas',
            'Grande_Area_cod_grande_area'=>'1',
        ]);
    }
}

class CidadeTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Cidade')->delete();

        DB::table('Cidade')->insert([
            'nome'=>'Ponta Grossa',
            'Estado_provincia_cod_est_prov'=>'1',
        ]);
    }
}

class SubareaTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Subarea')->delete();

        DB::table('Subarea')->insert([
            'nome'=>'Funções assintóticas',
            'Area_Conhecimento_cod_area_conhec'=>'1',
        ]);
    }
}

class DepartamentoTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Departamento')->delete();

        DB::table('Departamento')->insert([
            'nome'=>'Departamento de matemática ',
            'Setor_cod_setor'=>'1',
        ]);
    }
}

class PessoaTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Pessoa')->delete();

        DB::table('Pessoa')->insert([
            'cpf'=>'09587845550',
            'nome'=>'João',
            'sobrenome'=>'da Silva',
            'sexo'=>'M',
            'logradouro'=>'Av. General 10',
            'bairro'=>'Uvaranas',
            'CEP'=>'84030000',
            'Cidade_cod_cidade'=>'1',
        ]);
    }
}

class EspecialidadeTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Especialidade')->delete();

        DB::table('Especialidade')->insert([
            'nome'=>'Funções',
            'Subarea_cod_subarea'=>'1',
        ]);
    }
}

class AutorTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Autor')->delete();

        DB::table('Autor')->insert([
            'categoria'=>'1',
            'Departamento_cod_departamento'=>'1',
            'Pessoa_cod_pessoa'=>'1',
        ]);
    }
}

class EmailTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Email')->delete();

        DB::table('Email')->insert([
            'endereco'=>str_random(10).'@exemplo.com',
            'tipo'=>'1',
            'Pessoa_cod_pessoa'=>'1',
        ]);
    }
}

class TecnicoCatalografiaTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Tecnico_Catalografia')->delete();

        DB::table('Tecnico_Catalografia')->insert([
            'funcao'=>'1',
            'Pessoa_cod_pessoa'=>'1',
        ]);
    }
}

class TelefoneTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Telefone')->delete();

        DB::table('Telefone')->insert([
            'numero'=>'45988774455',
            'tipo'=>'1',
            'Pessoa_cod_pessoa'=>'1',
        ]);
    }
}

class UsuarioTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Usuario')->delete();

        DB::table('Usuario')->insert([
            'endereco_email'=>str_random(10).'@exemplo.com',
            'senha'=>'secret',
            'Pessoa_cod_pessoa'=>'1',
        ]);
    }
}

class AutorEspecialidadeTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Autor_Especialidade')->delete();

        DB::table('Autor_Especialidade')->insert([
            'Autor_cod_autor'=>'1',
            'Especialidade_cod_especialidade'=>'1',
        ]);
    }
}

class UsuarioPropositorTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Usuario_Propositor')->delete();

        DB::table('Usuario_Propositor')->insert([
            'Usuario_cod_usuario'=>'1',
        ]);
    }
}

class UsuarioPareceristaTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Usuario_Parecerista')->delete();

        DB::table('Usuario_Parecerista')->insert([
            'Usuario_cod_usuario'=>'1',
            'Departamento_cod_departamento'=>'1',
        ]);
    }
}

class UsuarioAdmTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Usuario_Adm')->delete();

        DB::table('Usuario_Adm')->insert([
            'Usuario_cod_usuario'=>'1',
        ]);
    }
}

class PropostaTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Proposta')->delete();

        DB::table('Proposta')->insert([
            'data_envio'=>'2017-01-09',
            'Usuario_Propositor_cod_propositor'=>'1',
            'Usuario_Adm_cod_adm'=>'1',
        ]);
    }
}

class UsuarioPareceristaEspecialidadeTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('Usuario_Parecerista_Especialidade')->delete();

        DB::table('Usuario_Parecerista_Especialidade')->insert([
            'Usuario_Parecerista_cod_parecerista'=>'1',
            'Especialidade_cod_especialidade'=>'1'
        ]);
    }
}

class OficioAlteracoesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Oficio_Alteracoes')->delete();

        DB::table('Oficio_Alteracoes')->insert([
            'url_documento'=>str_random(50),
            'Proposta_cod_proposta'=>'1',
        ]);
    }
}

class DocSugAltTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Doc_Sugestao_Alteracoes')->delete();

        DB::table('Doc_Sugestao_Alteracoes')->insert([
            'url_documento'=>str_random(50),
            'Proposta_cod_proposta'=>'1',
        ]);
    }
}

class NotificacaoTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Notificacao')->delete();

        DB::table('Notificacao')->insert([
            'descricao'=>str_random(140),
            'data'=>'2017-01-09',
            'Proposta_cod_proposta'=>'1',
        ]);
    }
}

class ParecerTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Parecer')->delete();

        DB::table('Parecer')->insert([
            'url_documento'=>str_random(50),
            'prazo_envio'=>'60',
            'data_envio'=>'2017-01-09',
            'Usuario_Parecerista_cod_parecerista'=>'1',
            'Proposta_cod_proposta'=>'1',
        ]);
    }
}

class ObraTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Obra')->delete();

        DB::table('Obra')->insert([
            'titulo'=>str_random(10),
            'subtitulo'=>str_random(10),
            'descricao'=>str_random(10),
            'volume'=>'1',
            'isbn'=>'1234-1234-123',
            'ano_publicacao'=>'2017',
            'resumo'=>str_random(10),
            'num_paginas'=>'250',
            'Proposta_cod_proposta'=>'1',
            'Autor_cod_autor'=>'1',
        ]);
    }
}

class PropTecCatTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Proposta_Tecnico_Catalografia')->delete();

        DB::table('Proposta_Tecnico_Catalografia')->insert([
            'Proposta_cod_proposta'=>'1',
            'Tecnico_Catalografia_cod_tec_catalog'=>'1',
        ]);
    }
}

class MaterialTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Material')->delete();

        DB::table('Material')->insert([
            'versao'=>'1',
            'url_documento'=>str_random(50),
            'url_imagens'=>str_random(50),
            'edicao'=>'1',
            'Obra_cod_obra'=>'1',
        ]);
    }
}

class ObraPalavrasChaveTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('Obra_Palavras_Chave')->delete();

        DB::table('Obra_Palavras_Chave')->insert([
            'Obra_cod_obra'=>'1',
            'Palavras_Chave_cod_pchave'=>'1',
        ]);
    }
}
