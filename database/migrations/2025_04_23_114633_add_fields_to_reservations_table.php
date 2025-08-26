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
        Schema::table('reservations', function (Blueprint $table) {

       
        $table->string('first_name_conducteur')->nullable();
        $table->string('last_name_conducteur')->nullable();
        $table->string('identity_number_conducteur')->nullable();
        $table->string('driver_license_number_conducteur')->nullable();
        $table->string('address_conducteur')->nullable();
        $table->string('nationality_conducteur')->nullable();
        $table->string('mobile_number_conducteur')->nullable();
        $table->date('identity_date_conducteur')->nullable();
        $table->date('license_date_conducteur')->nullable();
        $table->date('date_of_birth_conducteur')->nullable();
        $table->string('place_of_birth_conducteur')->nullable();
        $table->json('gallery_conducteur')->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn([
                
                'first_name_conducteur',
                'last_name_conducteur',
                'identity_number_conducteur',
                'driver_license_number_conducteur',
                'address_conducteur',
                'nationality_conducteur',
                'mobile_number_conducteur',
                'identity_date_conducteur',
                'license_date_conducteur',
                'date_of_birth_conducteur',
                'place_of_birth_conducteur',
                'gallery_conducteur',
            ]);
        });
    }
};
