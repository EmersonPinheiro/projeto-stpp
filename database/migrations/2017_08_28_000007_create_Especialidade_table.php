<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialidadeTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Especialidade';

    /**
     * Run the migrations.
     * @table Especialidade
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_especialidade');
            $table->string('nome', 50)->nullable();
            $table->integer('Subarea_cod_subarea')->unsigned();
            $table->timestamps();

            $table->index(["Subarea_cod_subarea"], 'fk_Especialidade_Subarea1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Subarea_cod_subarea', 'fk_Especialidade_Subarea1_idx')
                ->references('cod_subarea')->on('Subarea')
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
