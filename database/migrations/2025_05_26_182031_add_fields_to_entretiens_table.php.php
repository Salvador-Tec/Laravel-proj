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
        Schema::create('entretiens', function (Blueprint $table) {
            $table->id();

            // Clé étrangère vers la table 'cars'
            // Assure-toi que la table 'cars' existe et que la colonne 'id' est la clé primaire
            $table->foreignId('car_id')->constrained()->onDelete('cascade');

            $table->date('date_entretien');
            $table->integer('kilometrage')->nullable();
            $table->string('type_entretien')->nullable();

            $table->text('remarque')->nullable();
            $table->date('date_prochain_entretien')->nullable();
            $table->integer('kilometrage_prochain_entretien')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entretiens');
    }
};
