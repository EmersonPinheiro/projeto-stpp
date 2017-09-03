<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObraTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Obra';

    /**
     * Run the migrations.
     * @table Obra
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_obra');
            $table->string('titulo', 100)->nullable();
            $table->string('subtitulo', 100)->nullable();
            $table->string('descricao');
            $table->integer('volume')->nullable();
            $table->string('isbn', 13)->nullable();
            $table->smallInteger('ano_publicacao')->nullable();
            $table->string('resumo')->nullable();
            $table->integer('num_paginas')->nullable();
            $table->integer('Proposta_cod_proposta')->unsigned();
            $table->integer('Autor_cod_autor')->unsigned();

            $table->index(["Proposta_cod_proposta"], 'fk_Obra_Proposta1_idx');

            $table->index(["Autor_cod_autor"], 'fk_Obra_Autor1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Proposta_cod_proposta', 'fk_Obra_Proposta1_idx')
                ->references('cod_proposta')->on('Proposta')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('Autor_cod_autor', 'fk_Obra_Autor1_idx')
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
