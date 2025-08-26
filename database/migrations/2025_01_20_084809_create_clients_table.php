<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Vérifier si la table 'clients' n'existe pas avant de la créer
        if (!Schema::hasTable('clients')) {
            Schema::create('clients', function (Blueprint $table) {
                $table->id(); // ID auto-incrémenté
                $table->string('first_name'); // Prénom
                $table->string('last_name'); // Nom
                $table->string('nationality'); // Nationalité
                $table->string('identity_number')->unique(); // Numéro de carte d'identité
                $table->string('driver_license_number')->unique(); // Numéro de permis de conduire
                $table->string('address')->nullable(); // Adresse
                $table->string('mobile_number'); // Numéro de téléphone portable
                $table->json('gallery')->nullable(); // Fichiers téléchargés
                $table->timestamps(); // created_at et updated_at
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Supprimer la table si la migration est annulée
        Schema::dropIfExists('clients');
    }
};
