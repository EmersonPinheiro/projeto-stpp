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
            $table->string('email', 100)->unique();
            $table->string('password', 60);
            $table->integer('Pessoa_cod_pessoa')->unsigned();
            $table->rememberToken();
            $table->timestamps();

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
