<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Vérifier si la table 'cars' n'existe pas
        if (!Schema::hasTable('cars')) {
            Schema::create('cars', function (Blueprint $table) {
                $table->id();
                $table->string('brand');
                $table->string('model');
                $table->string('engine');
                $table->decimal('price_per_day', 8, 2);
                $table->string('image')->nullable();
                $table->string('quantity');
                $table->string('status')->default('available');
                $table->integer('reduce');
                $table->integer('stars');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // Supprimer la table 'cars' si elle existe
        Schema::dropIfExists('cars');
    }
};

