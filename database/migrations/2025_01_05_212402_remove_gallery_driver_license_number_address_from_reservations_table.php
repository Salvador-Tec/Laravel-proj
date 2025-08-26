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
        Schema::table('reservations', function (Blueprint $table) {
            // Vérification de l'existence des colonnes avant de les supprimer
            if (Schema::hasColumn('reservations', 'gallery')) {
                $table->dropColumn('gallery');
            }

            if (Schema::hasColumn('reservations', 'driver_license_number')) {
                $table->dropColumn('driver_license_number');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Réinsertion des colonnes supprimées
            $table->string('gallery')->nullable();
            $table->string('driver_license_number')->nullable();
        });
    }
};

