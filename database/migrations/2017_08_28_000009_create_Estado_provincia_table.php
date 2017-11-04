<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoProvinciaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Estado_provincia';

    /**
     * Run the migrations.
     * @table Estado_provincia
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_est_prov');
            $table->string('sigla', 2)->nullable();
            $table->string('nome', 50)->nullable();
            $table->integer('Pais_cod_pais')->unsigned();
            $table->timestamps();

            $table->index(["Pais_cod_pais"], 'fk_Estado_provincia_Pais1_idx');
        });
        Schema::table('Estado_provincia', function (Blueprint $table) {
            $table->foreign('Pais_cod_pais', 'fk_Estado_provincia_Pais1_idx')
                ->references('cod_pais')->on('Pais')
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
