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
        $table->string('matricule')->nullable();  // Ajouter le champ matricule
        $table->string('gearbox_type')->nullable();  // Ajouter le champ gearbox_type
    });
}

public function down()
{
    Schema::table('cars', function (Blueprint $table) {
        $table->dropColumn('matricule');  // Supprimer le champ matricule
        $table->dropColumn('gearbox_type');  // Supprimer le champ gearbox_type
    });
}

};
