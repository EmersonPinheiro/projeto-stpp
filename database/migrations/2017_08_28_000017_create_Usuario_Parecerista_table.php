<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioPareceristaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Usuario_Parecerista';

    /**
     * Run the migrations.
     * @table Usuario_Parecerista
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_parecerista');
            $table->integer('Usuario_cod_usuario')->unsigned();
            $table->integer('Departamento_cod_departamento')->unsigned();
            $table->timestamps();

            $table->index(["Departamento_cod_departamento"], 'fk_Usuario_Parecerista_Departamento1_idx');

            $table->index(["Usuario_cod_usuario"], 'fk_Usuario_Parecerista_Usuario1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Usuario_cod_usuario', 'fk_Usuario_Parecerista_Usuario1_idx')
                ->references('cod_usuario')->on('Usuario')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('Departamento_cod_departamento', 'fk_Usuario_Parecerista_Departamento1_idx')
                ->references('cod_departamento')->on('Departamento')
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
