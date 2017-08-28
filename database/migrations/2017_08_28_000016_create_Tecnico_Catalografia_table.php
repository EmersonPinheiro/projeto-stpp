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
            $table->increments('cod_tec_catalog');
            $table->integer('funcao')->nullable();
            $table->string('Pessoa_cpf', 11);

            $table->index(["Pessoa_cpf"], 'fk_Tecnico_Catalografia_Pessoa1_idx');


            $table->foreign('Pessoa_cpf', 'fk_Tecnico_Catalografia_Pessoa1_idx')
                ->references('cpf')->on('Pessoa')
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
