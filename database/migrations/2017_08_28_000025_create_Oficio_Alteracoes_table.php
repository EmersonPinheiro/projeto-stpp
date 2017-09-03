<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOficioAlteracoesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Oficio_Alteracoes';

    /**
     * Run the migrations.
     * @table Oficio_Alteracoes
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_oficio');
            $table->string('url_documento', 100)->nullable();
            $table->integer('Proposta_cod_proposta')->unsigned();

            $table->index(["Proposta_cod_proposta"], 'fk_Oficio_Alteracoes_Proposta1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Proposta_cod_proposta', 'fk_Oficio_Alteracoes_Proposta1_idx')
                ->references('cod_proposta')->on('Proposta')
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
