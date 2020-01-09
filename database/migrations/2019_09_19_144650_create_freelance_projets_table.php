<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreelanceProjetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelance_projets', function (Blueprint $table) {
            $table->increments('id_fprojet');
            $table->string('titre_projet');
            $table->text('contenu');
            $table->integer('id_user');
            $table->integer('reponses');
            $table->integer('etat');
            $table->integer('categorie');
            $table->string('prix');
            $table->boolean('actif');
            $table->integer('booster');
            $table->string('type');
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
        Schema::dropIfExists('freelance_projets');
    }
}
