<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvitePareceristaTable extends Migration
{

    public $set_schema_table = 'Convite_Parecerista';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (Schema::hasTable($this->set_schema_table)) return;
      Schema::create($this->set_schema_table, function (Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->increments('id');
          $table->string('nome', 100);
          $table->string('sobrenome', 100);
          $table->string('email');
          $table->string('token', 16)->unique();
          $table->date('prazo')->nullable();
          $table->integer('Proposta_cod_proposta')->unsigned();
          $table->timestamps();

          $table->index(["Proposta_cod_proposta"], 'fk_Convite_Parecerista_Proposta1_idx');

      });

      Schema::table($this->set_schema_table, function (Blueprint $table) {
          $table->foreign('Proposta_cod_proposta', 'fk_Convite_Parecerista_Proposta1_idx')
              ->references('cod_proposta')->on('Proposta')
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
