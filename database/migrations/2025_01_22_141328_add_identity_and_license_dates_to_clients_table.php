<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_identity_and_license_dates_to_clients_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdentityAndLicenseDatesToClientsTable extends Migration
{
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            // Vérifier si les colonnes 'identity_date' et 'license_date' n'existent pas avant de les ajouter
            if (!Schema::hasColumn('clients', 'identity_date')) {
                $table->date('identity_date')->nullable(); // Date de carte d'identité
            }

            if (!Schema::hasColumn('clients', 'license_date')) {
                $table->date('license_date')->nullable();  // Date de permis de conduire
            }
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            // Vérifier si les colonnes 'identity_date' et 'license_date' existent avant de les supprimer
            if (Schema::hasColumn('clients', 'identity_date')) {
                $table->dropColumn('identity_date');
            }

            if (Schema::hasColumn('clients', 'license_date')) {
                $table->dropColumn('license_date');
            }
        });
    }
}

