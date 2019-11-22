<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoosterListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booster_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_fprojet');
            $table->integer('type_forfait');
            $table->integer('unite');
            $table->date('fin');
            $table->date('fin');
            $table->boolean('actif');
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
        Schema::dropIfExists('booster_lists');
    }
}
