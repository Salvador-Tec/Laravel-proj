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
         Schema::create('radars', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('car_id')->nullable();
        $table->string('matricule');
        $table->string('modele')->nullable();
        $table->date('date_infraction')->nullable();
        $table->date('date_traitement')->nullable();
        $table->string('numero_contrat')->nullable();
        $table->boolean('traite')->default(false);
        $table->timestamps();

        $table->foreign('car_id')->references('id')->on('cars')->onDelete('set null');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radars');
    }
};
