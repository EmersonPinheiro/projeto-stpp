<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutorTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Autor';

    /**
     * Run the migrations.
     * @table Autor
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_autor');
            $table->integer('categoria')->nullable();
            $table->string('Pessoa_cpf', 11);
            $table->integer('Departamento_cod_departamento');

            $table->index(["Pessoa_cpf"], 'fk_Autor_Pessoa1_idx');

            $table->index(["Departamento_cod_departamento"], 'fk_Autor_Departamento1_idx');


            $table->foreign('Pessoa_cpf', 'fk_Autor_Pessoa1_idx')
                ->references('cpf')->on('Pessoa')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('Departamento_cod_departamento', 'fk_Autor_Departamento1_idx')
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
