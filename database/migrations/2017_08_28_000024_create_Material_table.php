<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Material';

    /**
     * Run the migrations.
     * @table Material
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_material');
            $table->integer('versao')->default(1);
            $table->string('url_documento', 150)->nullable();
            $table->string('url_documento_nao_ident', 150)->nullable();
            $table->string('url_imagens', 150)->nullable();
            $table->integer('edicao')->nullable();
            $table->integer('Obra_cod_obra')->unsigned();
            $table->timestamps();

            $table->index(["Obra_cod_obra"], 'fk_Material_Obra1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Obra_cod_obra', 'fk_Material_Obra1_idx')
                ->references('cod_obra')->on('Obra')
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
