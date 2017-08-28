<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObraPalavrasChaveTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Obra_Palavras_Chave';

    /**
     * Run the migrations.
     * @table Obra_Palavras_Chave
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('Obra_cod_obra');
            $table->integer('Palavras_Chave_cod_pchave');

            $table->index(["Obra_cod_obra"], 'fk_Obra_has_Palavras_Chave_Obra1_idx');

            $table->index(["Palavras_Chave_cod_pchave"], 'fk_Obra_has_Palavras_Chave_Palavras_Chave1_idx');


            $table->foreign('Obra_cod_obra', 'fk_Obra_has_Palavras_Chave_Obra1_idx')
                ->references('cod_obra')->on('Obra')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('Palavras_Chave_cod_pchave', 'fk_Obra_has_Palavras_Chave_Palavras_Chave1_idx')
                ->references('cod_pchave')->on('Palavras_Chave')
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
