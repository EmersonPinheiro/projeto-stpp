<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVinculoInstitucionalTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'Vinculo_Institucional';

    /**
     * Run the migrations.
     * @table Setor
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('cod_vinculo');
            $table->string('nome', 200)->nullable();
            $table->integer('Instituicao_cod_instituicao')->unsigned();
            $table->timestamps();

            $table->index(["Instituicao_cod_instituicao"], 'fk_Vinculo_Instituicao1_idx');
        });
        Schema::table($this->set_schema_table, function (Blueprint $table) {
            $table->foreign('Instituicao_cod_instituicao', 'fk_Vinculo_Instituicao1_idx')
                ->references('cod_instituicao')->on('Instituicao')
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
