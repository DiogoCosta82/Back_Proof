<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('indicateur', function (Blueprint $table) {
            $table->increments('id')->foreign('dossier.indicateur_id');
            $table->integer('nom_indicateur');
            $table->unsignedInteger('criteres_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicateur');
    }
};
