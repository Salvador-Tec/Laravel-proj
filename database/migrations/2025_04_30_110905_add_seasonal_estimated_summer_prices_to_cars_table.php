<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeasonalEstimatedSummerPricesToCarsTable extends Migration
{
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->decimal('seasonal_price', 10, 2)
                  ->after('price_per_day')
                  ->default(0);
                  
            $table->decimal('estimated_price', 10, 2)
                  ->after('seasonal_price')
                  ->default(0);
                  
            $table->decimal('summer_price', 10, 2)
                  ->after('estimated_price')
                  ->default(0);
        });
    }

    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['seasonal_price', 'estimated_price', 'summer_price']);
        });
    }
}