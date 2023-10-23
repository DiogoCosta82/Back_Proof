<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndicateurDataTable extends Migration
{
    public function up()
    {
        Schema::create('indicateur_data', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('dossier_id')->unsigned();
            $table->integer('indicateur_id')->unsigned();
            $table->text('texte_indicateur');
            $table->text('liens_preuve');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('indicateur_data');
    }
}