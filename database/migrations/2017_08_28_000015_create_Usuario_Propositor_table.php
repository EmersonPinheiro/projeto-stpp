<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioPropositorTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Usuario_Propositor';

    /**
     * Run the migrations.
     * @table Usuario_Propositor
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_propositor');
            $table->integer('Usuario_cod_usuario')->unsigned();
            $table->integer('Instituicao_cod_instituicao')->unsigned();
            $table->timestamps();

            $table->index(["Instituicao_cod_instituicao"], 'fk_Usuario_Propositor_Instituicao1_idx');
            $table->index(["Usuario_cod_usuario"], 'fk_Usuario_Propositor_Usuario1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Usuario_cod_usuario', 'fk_Usuario_Propositor_Usuario1_idx')
                ->references('cod_usuario')->on('Usuario')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('Instituicao_cod_instituicao', 'fk_Usuario_Propositor_Instituicao1_idx')
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
