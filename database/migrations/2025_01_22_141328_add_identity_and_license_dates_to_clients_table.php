<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_identity_and_license_dates_to_reservations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdentityAndLicenseDatesToClientsTable extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            // Ajouter les colonnes pour les dates
            $table->date('identity_date')->nullable(); // Date de carte d'identité
            $table->date('license_date')->nullable();  // Date de permis de conduire
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            // Supprimer les colonnes si la migration est annulée
            $table->dropColumn('identity_date');
            $table->dropColumn('license_date');
        });
    }
}
