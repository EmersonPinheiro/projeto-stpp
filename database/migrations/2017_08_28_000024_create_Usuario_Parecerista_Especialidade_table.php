<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioPareceristaEspecialidadeTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Usuario_Parecerista_Especialidade';

    /**
     * Run the migrations.
     * @table Usuario_Parecerista_Especialidade
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('Usuario_Parecerista_cod_parecerista')->unsigned();
            $table->integer('Especialidade_cod_especialidade')->unsigned();

            $table->index(["Especialidade_cod_especialidade"], 'fk_Usuario_Parecerista_has_Especialidade_Especialidade1_idx');

            $table->index(["Usuario_Parecerista_cod_parecerista"], 'fk_Usuario_Parecerista_has_Especialidade_Usuario_Parecerist_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Usuario_Parecerista_cod_parecerista', 'fk_Usuario_Parecerista_has_Especialidade_Usuario_Parecerist_idx')
                ->references('cod_parecerista')->on('Usuario_Parecerista')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('Especialidade_cod_especialidade', 'fk_Usuario_Parecerista_has_Especialidade_Especialidade1_idx')
                ->references('cod_especialidade')->on('Especialidade')
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
