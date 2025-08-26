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
        Schema::table('users', function (Blueprint $table) {
            // Vérification de l'existence de la colonne 'cin' avant de la supprimer
            if (Schema::hasColumn('users', 'cin')) {
                $table->dropColumn('cin');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajout de la colonne 'cin' dans la migration 'down'
            $table->string('cin')->nullable();
        });
    }
};

