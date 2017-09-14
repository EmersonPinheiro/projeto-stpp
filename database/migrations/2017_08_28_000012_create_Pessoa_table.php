<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Pessoa';

    /**
     * Run the migrations.
     * @table Pessoa
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_pessoa');
            $table->string('cpf', 11)->unique();
            $table->string('nome', 50)->nullable();
            $table->string('sobrenome', 100)->nullable();
            $table->char('sexo', 1)->nullable();
            $table->string('logradouro')->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('CEP', 8)->nullable();
            $table->integer('Cidade_cod_cidade')->unsigned();

            $table->index(["Cidade_cod_cidade"], 'fk_Pessoa_Cidade1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Cidade_cod_cidade', 'fk_Pessoa_Cidade1_idx')
                ->references('cod_cidade')->on('Cidade')
                ->onDelete('no action')
                ->onUpdate('no action');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
