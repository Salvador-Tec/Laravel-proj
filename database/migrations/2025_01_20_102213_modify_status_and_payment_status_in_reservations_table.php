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
        Schema::table('reservations', function (Blueprint $table) {
            // Modifier la colonne "status" pour accepter n'importe quelle chaîne de caractères
            $table->string('status')->nullable()->change();
            
            // Modifier la colonne "payment_status" pour accepter n'importe quelle chaîne de caractères
            $table->string('payment_status')->nullable()->change();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Revenir à l'état d'origine, avec les valeurs enum
            $table->enum('status', ['active', 'completed', 'canceled'])->default('active')->change();
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending')->change();
        });
    }
    
};
