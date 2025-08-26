<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAmountPaidToReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Vérifier si la colonne 'amount_paid' existe avant de l'ajouter
            if (!Schema::hasColumn('reservations', 'amount_paid')) {
                // Ajoute une colonne 'amount_paid' de type decimal
                $table->decimal('amount_paid', 10, 2)->default(0)->after('payment_status'); // Vous pouvez modifier 'after' selon la position
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Vérifier si la colonne 'amount_paid' existe avant de la supprimer
            if (Schema::hasColumn('reservations', 'amount_paid')) {
                // Supprimer la colonne 'amount_paid'
                $table->dropColumn('amount_paid');
            }
        });
    }
}

