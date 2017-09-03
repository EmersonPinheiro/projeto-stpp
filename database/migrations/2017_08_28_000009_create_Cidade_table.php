<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidadeTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Cidade';

    /**
     * Run the migrations.
     * @table Cidade
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_cidade');
            $table->string('nome', 50)->nullable();
            $table->integer('Estado_provincia_cod_est_prov')->unsigned();

            $table->index(["Estado_provincia_cod_est_prov"], 'fk_Cidade_Estado_provincia1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Estado_provincia_cod_est_prov', 'fk_Cidade_Estado_provincia1_idx')
                ->references('cod_est_prov')->on('Estado_provincia')
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
