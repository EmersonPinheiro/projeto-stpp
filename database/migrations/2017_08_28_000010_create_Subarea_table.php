<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubareaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Subarea';

    /**
     * Run the migrations.
     * @table Subarea
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_subarea');
            $table->string('nome', 100)->nullable();
            $table->integer('Area_Conhecimento_cod_area_conhec');

            $table->index(["Area_Conhecimento_cod_area_conhec"], 'fk_Subarea_Area_Conhecimento1_idx');


            $table->foreign('Area_Conhecimento_cod_area_conhec', 'fk_Subarea_Area_Conhecimento1_idx')
                ->references('cod_area_conhec')->on('Area_Conhecimento')
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
