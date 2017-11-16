<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParecerTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Parecer';

    /**
     * Run the migrations.
     * @table Parecer
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_parecer');
            $table->string('url_documento', 150)->nullable();
            $table->date('prazo_envio')->nullable();
            $table->date('data_envio')->nullable();
            $table->integer('Usuario_Parecerista_cod_parecerista')->unsigned();
            $table->integer('Proposta_cod_proposta')->unsigned();
            $table->timestamps();

            $table->index(["Proposta_cod_proposta"], 'fk_Parecer_Proposta1_idx');

            $table->index(["Usuario_Parecerista_cod_parecerista"], 'fk_Parecer_Usuario_Parecerista1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Usuario_Parecerista_cod_parecerista', 'fk_Parecer_Usuario_Parecerista1_idx')
                ->references('cod_parecerista')->on('Usuario_Parecerista')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('Proposta_cod_proposta', 'fk_Parecer_Proposta1_idx')
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
