<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutorEspecialidadeTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Autor_Especialidade';

    /**
     * Run the migrations.
     * @table Autor_Especialidade
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('Autor_cod_autor')->unsigned();
            $table->integer('Especialidade_cod_especialidade')->unsigned();
            $table->timestamps();

            $table->index(["Especialidade_cod_especialidade"], 'fk_Autor_has_Especialidade_Especialidade1_idx');

            $table->index(["Autor_cod_autor"], 'fk_Autor_has_Especialidade_Autor1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Autor_cod_autor', 'fk_Autor_has_Especialidade_Autor1_idx')
                ->references('cod_autor')->on('Autor')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('Especialidade_cod_especialidade', 'fk_Autor_has_Especialidade_Especialidade1_idx')
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
