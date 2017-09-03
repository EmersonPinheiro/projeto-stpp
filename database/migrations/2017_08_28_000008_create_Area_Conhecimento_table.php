<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaConhecimentoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Area_Conhecimento';

    /**
     * Run the migrations.
     * @table Area_Conhecimento
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_area_conhec');
            $table->string('nome', 100)->nullable();
            $table->integer('Grande_Area_cod_grande_area')->unsigned();

            $table->index(["Grande_Area_cod_grande_area"], 'fk_Area_Conhecimento_Grande_Area1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Grande_Area_cod_grande_area', 'fk_Area_Conhecimento_Grande_Area1_idx')
                ->references('cod_grande_area')->on('Grande_Area')
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
