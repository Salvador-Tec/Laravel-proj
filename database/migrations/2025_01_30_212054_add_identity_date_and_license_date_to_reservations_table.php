<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdentityDateAndLicenseDateToReservationsTable extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Vérifier si les colonnes 'identity_date' et 'license_date' n'existent pas déjà avant de les ajouter
            if (!Schema::hasColumn('reservations', 'identity_date')) {
                $table->date('identity_date')->nullable()->after('driver_license_number'); 
            }

            if (!Schema::hasColumn('reservations', 'license_date')) {
                $table->date('license_date')->nullable()->after('identity_date');
            }
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Vérifier si les colonnes 'identity_date' et 'license_date' existent avant de les supprimer
            if (Schema::hasColumn('reservations', 'identity_date')) {
                $table->dropColumn('identity_date');
            }

            if (Schema::hasColumn('reservations', 'license_date')) {
                $table->dropColumn('license_date');
            }
        });
    }
}

