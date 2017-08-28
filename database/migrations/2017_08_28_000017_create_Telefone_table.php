<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefoneTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Telefone';

    /**
     * Run the migrations.
     * @table Telefone
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_telefone');
            $table->string('numero', 14)->nullable();
            $table->integer('tipo')->nullable();
            $table->string('Pessoa_cpf', 11);

            $table->index(["Pessoa_cpf"], 'fk_Telefone_Pessoa_idx');


            $table->foreign('Pessoa_cpf', 'fk_Telefone_Pessoa_idx')
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
