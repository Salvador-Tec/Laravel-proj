<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécuter la migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Vérifier si la colonne 'date_of_birth' n'existe pas déjà avant de l'ajouter
            if (!Schema::hasColumn('reservations', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable();
            }

            // Vérifier si la colonne 'place_of_birth' n'existe pas déjà avant de l'ajouter
            if (!Schema::hasColumn('reservations', 'place_of_birth')) {
                $table->string('place_of_birth')->nullable();
            }
        });
    }

    /**
     * Revenir en arrière si besoin.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Vérifier si la colonne 'date_of_birth' existe avant de la supprimer
            if (Schema::hasColumn('reservations', 'date_of_birth')) {
                $table->dropColumn('date_of_birth');
            }

            // Vérifier si la colonne 'place_of_birth' existe avant de la supprimer
            if (Schema::hasColumn('reservations', 'place_of_birth')) {
                $table->dropColumn('place_of_birth');
            }
        });
    }
};
