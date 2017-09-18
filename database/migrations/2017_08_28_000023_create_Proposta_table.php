<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropostaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Proposta';

    /**
     * Run the migrations.
     * @table Proposta
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_proposta');
            $table->date('data_envio');
            $table->enum('situacao', ['Submetida', 'Em avaliação', 'Aguardando parecer', 'Aguardando decisão do Conselho Editorial', 'Em trâmite'])->nullable()->default('Submetida');
            $table->integer('Usuario_Propositor_cod_propositor')->unsigned();
            $table->integer('Usuario_Adm_cod_adm')->unsigned()->nullable();

            $table->index(["Usuario_Propositor_cod_propositor"], 'fk_Proposta_Usuario_Autor1_idx');

            $table->index(["Usuario_Adm_cod_adm"], 'fk_Proposta_Usuario_Adm1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Usuario_Propositor_cod_propositor', 'fk_Proposta_Usuario_Autor1_idx')
                ->references('cod_propositor')->on('Usuario_Propositor')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('Usuario_Adm_cod_adm', 'fk_Proposta_Usuario_Adm1_idx')
                ->references('cod_adm')->on('Usuario_Adm')
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
