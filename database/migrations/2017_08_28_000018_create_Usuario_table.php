<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Usuario';

    /**
     * Run the migrations.
     * @table Usuario
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('endereco_email');
            $table->string('senha', 30)->nullable();
            $table->string('Pessoa_cpf', 11);

            $table->index(["Pessoa_cpf"], 'fk_Usuario_Pessoa1_idx');


            $table->foreign('Pessoa_cpf', 'fk_Usuario_Pessoa1_idx')
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
