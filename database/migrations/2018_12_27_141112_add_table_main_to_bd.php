<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableMainToBd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_report', function (Blueprint $table) {
            $table->increments('id');
            $table->char('temperature');
            $table->char('max_temperature');
            $table->char('min_temperature');
            $table->char('weather');
            $table->char('clouds');
            $table->char('wind_speed');
            $table->char('wind_direction');
            $table->char('precipitation_type');
            $table->char('precipitation_size');
            $table->char('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_report');
    }
}
