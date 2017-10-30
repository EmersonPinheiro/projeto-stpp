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
          $table->string('email');
          $table->string('proposta');
          $table->string('token', 16)->unique();
          $table->boolean('aceito')->default(false);
          $table->date('prazo')->nullable();
          $table->timestamps();
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
