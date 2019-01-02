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
        Schema::table('bd', function (Blueprint $table) {
            $table->increments('id');
            $table->char('temperature');
            $table->char('maxtemperature');
            $table->char('min temperature');
            $table->char('weather');
            $table->char('clouds');
            $table->char('wind_speed');
            $table->char('wind_direction');
            $table->char('precipitation_type');
            $table->char('precipitation_size');
            $table->char('data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bd', function (Blueprint $table) {
            //
        });
    }
}
