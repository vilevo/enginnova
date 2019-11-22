<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamplanningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teamplannings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre');
            $table->integer('id_fprojet');
            $table->integer('id_workspace');
            $table->boolean('valider');
            $table->date('debut');
            $table->date('fin');
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
        Schema::dropIfExists('teamplannings');
    }
}
