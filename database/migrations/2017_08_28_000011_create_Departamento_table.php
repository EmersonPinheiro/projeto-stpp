<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartamentoTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Departamento';

    /**
     * Run the migrations.
     * @table Departamento
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_departamento');
            $table->string('nome', 100)->nullable();
            $table->integer('Setor_cod_setor');

            $table->index(["Setor_cod_setor"], 'fk_Departamento_Setor1_idx');


            $table->foreign('Setor_cod_setor', 'fk_Departamento_Setor1_idx')
                ->references('cod_setor')->on('Setor')
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
