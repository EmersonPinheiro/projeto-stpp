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
            $table->increments('cod_usuario');
            $table->string('endereco_email', 100);
            $table->string('senha', 30)->nullable();
            $table->integer('Pessoa_cod_pessoa')->unsigned();

            $table->index(["Pessoa_cod_pessoa"], 'fk_Usuario_Pessoa1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Pessoa_cod_pessoa', 'fk_Usuario_Pessoa1_idx')
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
