<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObraTecnicoCatalografiaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Obra_Tecnico_Catalografia';

    /**
     * Run the migrations.
     * @table Obra_Tecnico_Catalografia
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('Obra_cod_obra')->unsigned();
            $table->integer('Tecnico_Catalografia_cod_tec_catalog')->unsigned();
            $table->timestamps();

            $table->index(["Obra_cod_obra"], 'fk_Obra_has_Tecnico_Catalografia_Obra1_idx');

            $table->index(["Tecnico_Catalografia_cod_tec_catalog"], 'fk_Obra_has_Tecnico_Catalografia_Tecnico_Catalografia1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Obra_cod_obra', 'fk_Obra_has_Tecnico_Catalografia_Obra1_idx')
                ->references('cod_obra')->on('Obra')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('Tecnico_Catalografia_cod_tec_catalog', 'fk_Obra_has_Tecnico_Catalografia_Tecnico_Catalografia1_idx')
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
