<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropostaTecnicoCatalografiaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Proposta_Tecnico_Catalografia';

    /**
     * Run the migrations.
     * @table Proposta_Tecnico_Catalografia
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('Proposta_cod_proposta');
            $table->integer('Tecnico_Catalografia_cod_tec_catalog');

            $table->index(["Proposta_cod_proposta"], 'fk_Proposta_has_Tecnico_Catalografia_Proposta1_idx');

            $table->index(["Tecnico_Catalografia_cod_tec_catalog"], 'fk_Proposta_has_Tecnico_Catalografia_Tecnico_Catalografia1_idx');


            $table->foreign('Proposta_cod_proposta', 'fk_Proposta_has_Tecnico_Catalografia_Proposta1_idx')
                ->references('cod_proposta')->on('Proposta')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('Tecnico_Catalografia_cod_tec_catalog', 'fk_Proposta_has_Tecnico_Catalografia_Tecnico_Catalografia1_idx')
                ->references('cod_tec_catalog')->on('Tecnico_Catalografia')
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
