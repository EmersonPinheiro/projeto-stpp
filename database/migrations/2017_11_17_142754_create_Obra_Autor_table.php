<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObraAutorTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Obra_Autor';

    /**
     * Run the migrations.
     * @table Obra_Autor
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('Obra_cod_obra')->unsigned();
            $table->integer('Autor_cod_autor')->unsigned();
            $table->timestamps();

            $table->index(["Obra_cod_obra"], 'fk_Obra_has_Autor_Obra1_idx');

            $table->index(["Autor_cod_autor"], 'fk_Obra_has_Autor_Autor1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Obra_cod_obra', 'fk_Obra_has_Autor_Obra1_idx')
                ->references('cod_obra')->on('Obra')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('Autor_cod_autor', 'fk_Obra_has_Autor_Autor1_idx')
                ->references('cod_autor')->on('Autor')
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
