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
           Schema::table('cars', function (Blueprint $table) {
            $table->string('numero_serie')->nullable()->after('status');
            $table->date('date_dpme')->nullable()->after('numero_serie');
            $table->date('date_dde')->nullable()->after('date_dpme');
            $table->date('date_echeance_leasing')->nullable()->after('date_dde');
            $table->string('etat_echeance_leasing')->nullable()->after('date_echeance_leasing');
            $table->string('reglement')->nullable()->after('etat_echeance_leasing');
            $table->string('nom_societe')->nullable()->after('reglement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn([
                'numero_serie',
                'date_dpme',
                'date_dde',
                'date_echeance_leasing',
                'etat_echeance_leasing',
                'reglement',
                'nom_societe',
            ]);
        });
    }
};
