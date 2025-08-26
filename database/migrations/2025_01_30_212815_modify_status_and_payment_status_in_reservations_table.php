<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStatusAndPaymentStatusInReservationsTable extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Vérifier si les colonnes 'status' et 'payment_status' existent avant de les modifier
            if (Schema::hasColumn('reservations', 'status')) {
                $table->string('status')->default('inactive')->change();
            }

            if (Schema::hasColumn('reservations', 'payment_status')) {
                $table->string('payment_status')->default('non payé')->change();
            }
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Vérifier si les colonnes 'status' et 'payment_status' existent avant de les modifier
            if (Schema::hasColumn('reservations', 'status')) {
                $table->enum('status', ['active', 'completed', 'canceled'])->default('active')->change();
            }

            if (Schema::hasColumn('reservations', 'payment_status')) {
                $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending')->change();
            }
        });
    }
}
