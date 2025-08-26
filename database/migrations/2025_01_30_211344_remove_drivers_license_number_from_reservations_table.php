<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDriversLicenseNumberFromReservationsTable extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Vérifier si la colonne 'drivers_license_number' existe avant de la supprimer
            if (Schema::hasColumn('reservations', 'drivers_license_number')) {
                $table->dropColumn('drivers_license_number');
            }
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Vérifier si la colonne 'drivers_license_number' n'existe pas avant de l'ajouter
            if (!Schema::hasColumn('reservations', 'drivers_license_number')) {
                $table->string('drivers_license_number')->nullable(); // Remettre la colonne en cas de rollback
            }
        });
    }
}

