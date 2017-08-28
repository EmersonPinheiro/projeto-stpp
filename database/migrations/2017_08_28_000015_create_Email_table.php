<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Email';

    /**
     * Run the migrations.
     * @table Email
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_email');
            $table->string('endereco', 100)->nullable();
            $table->integer('tipo')->nullable();
            $table->string('Pessoa_cpf', 11);

            $table->index(["Pessoa_cpf"], 'fk_E-mail_Pessoa1_idx');


            $table->foreign('Pessoa_cpf', 'fk_E-mail_Pessoa1_idx')
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
