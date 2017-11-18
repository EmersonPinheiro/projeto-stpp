<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutorTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Autor';

    /**
     * Run the migrations.
     * @table Autor
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_autor');
            $table->integer('categoria')->default(1);
            $table->integer('Pessoa_cod_pessoa')->unsigned();
            $table->integer('Instituicao_cod_instituicao')->unsigned()->nullable();
            $table->timestamps();

            $table->index(["Pessoa_cod_pessoa"], 'fk_Autor_Pessoa1_idx');
            $table->index(["Instituicao_cod_instituicao"], 'fk_Autor_Instituicao1_idx');

        });

        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Pessoa_cod_pessoa', 'fk_Autor_Pessoa1_idx')
                ->references('cod_pessoa')->on('Pessoa')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('Instituicao_cod_instituicao', 'fk_Autor_Instituicao1_idx')
                ->references('cod_instituicao')->on('Instituicao')
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
