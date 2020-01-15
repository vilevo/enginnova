<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('verifyToken');
            $table->boolean('status')->default(false);
            $table->string('telephone')->default('vide');
            $table->string('avatar')->default('default.png');
            $table->string('profession')->default('vide');
            $table->string('competences')->default('vide');
            $table->string('ville')->default('vide');
            $table->string('adresse')->default('vide');
            $table->string('description')->default('vide');
            $table->integer('count_note')->default(0);
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
