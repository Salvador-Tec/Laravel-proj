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
        Schema::create('assurances', function (Blueprint $table) {
            $table->id();

            // Clé étrangère vers la table cars (assure-toi que cette table existe)
            $table->foreignId('car_id')->constrained()->onDelete('cascade');

            $table->string('marque')->nullable();
            $table->string('model')->nullable();

            $table->string('nom');          // nom de l'assurance
            $table->date('date_debut');     // date début de validité
            $table->date('date_fin');       // date fin de validité
            $table->decimal('montant', 10, 2)->nullable(); // montant (avec 2 décimales)

            $table->integer('jours_restants')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assurances');
    }
};
