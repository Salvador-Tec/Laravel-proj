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
        // Vérifie si la table 'reservations' existe avant de la supprimer
        if (Schema::hasTable('reservations')) {
            Schema::dropIfExists('reservations');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Vérifie si la table 'reservations' n'existe pas avant de la recréer
        if (!Schema::hasTable('reservations')) {
            Schema::create('reservations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('car_id');
                $table->string('first_name');
                $table->string('last_name');
                $table->date('start_date');
                $table->date('end_date');
                $table->string('nationality');
                $table->string('identity_number');
                $table->string('mobile_number');
                $table->string('gallery')->nullable();
                $table->string('driver_license_number')->nullable();
                $table->string('address')->nullable();
                $table->string('reservation_dates'); // Ajustez le format de la date si nécessaire
                $table->string('delivery_time');
                $table->string('return_time');
                $table->integer('days');
                $table->integer('price_per_day');
                $table->integer('total_price');
                $table->enum('status', ['active', 'completed', 'canceled'])->default('active');
                $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
                $table->string('payment_method')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
};

