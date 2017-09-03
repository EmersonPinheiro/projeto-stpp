<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTecnicoCatalografiaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Tecnico_Catalografia';

    /**
     * Run the migrations.
     * @table Tecnico_Catalografia
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_tec_catalog')->unsigned();
            $table->integer('funcao')->nullable();
            $table->integer('Pessoa_cod_pessoa')->unsigned();

            $table->index(["Pessoa_cod_pessoa"], 'fk_Tecnico_Catalografia_Pessoa1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Pessoa_cod_pessoa', 'fk_Tecnico_Catalografia_Pessoa1_idx')
                ->references('cod_pessoa')->on('Pessoa')
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
