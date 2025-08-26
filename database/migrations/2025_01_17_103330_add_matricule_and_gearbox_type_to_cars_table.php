<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            // Ajouter le champ 'matricule' seulement s'il n'existe pas
            if (!Schema::hasColumn('cars', 'matricule')) {
                $table->string('matricule')->nullable();  // Ajouter le champ matricule
            }

            // Ajouter le champ 'gearbox_type' seulement s'il n'existe pas
            if (!Schema::hasColumn('cars', 'gearbox_type')) {
                $table->string('gearbox_type')->nullable();  // Ajouter le champ gearbox_type
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            // Supprimer le champ 'matricule' seulement s'il existe
            if (Schema::hasColumn('cars', 'matricule')) {
                $table->dropColumn('matricule');  // Supprimer le champ matricule
            }

            // Supprimer le champ 'gearbox_type' seulement s'il existe
            if (Schema::hasColumn('cars', 'gearbox_type')) {
                $table->dropColumn('gearbox_type');  // Supprimer le champ gearbox_type
            }
        });
    }
};

