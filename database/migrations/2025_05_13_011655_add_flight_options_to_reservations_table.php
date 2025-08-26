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
            // Vérification si 'manual_price' existe déjà, et si non, l'ajouter
            if (!Schema::hasColumn('reservations', 'manual_price')) {
                $table->decimal('manual_price', 10, 2)->nullable()->after('gallery_conducteur');
            }

            // Vérification pour les autres colonnes
            if (!Schema::hasColumn('reservations', 'numero_vol')) {
                $table->string('numero_vol')->nullable()->after('manual_price');
            }

            if (!Schema::hasColumn('reservations', 'avec_chauffeur')) {
                $table->boolean('avec_chauffeur')->nullable()->after('numero_vol');
            }

            if (!Schema::hasColumn('reservations', 'siege_bebe')) {
                $table->boolean('siege_bebe')->nullable()->after('avec_chauffeur');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Suppression des colonnes ajoutées
            if (Schema::hasColumn('reservations', 'siege_bebe')) {
                $table->dropColumn('siege_bebe');
            }

            if (Schema::hasColumn('reservations', 'avec_chauffeur')) {
                $table->dropColumn('avec_chauffeur');
            }

            if (Schema::hasColumn('reservations', 'numero_vol')) {
                $table->dropColumn('numero_vol');
            }

            if (Schema::hasColumn('reservations', 'manual_price')) {
                $table->dropColumn('manual_price');
            }
        });
    
    }
};
