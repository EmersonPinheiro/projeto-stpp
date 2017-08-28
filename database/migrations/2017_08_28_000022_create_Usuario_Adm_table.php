<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioAdmTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Usuario_Adm';

    /**
     * Run the migrations.
     * @table Usuario_Adm
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_adm');
            $table->string('Usuario_endereco_email', 100);

            $table->index(["Usuario_endereco_email"], 'fk_Usuario_Adm_Usuario1_idx');


            $table->foreign('Usuario_endereco_email', 'fk_Usuario_Adm_Usuario1_idx')
                ->references('endereco_email')->on('Usuario')
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
