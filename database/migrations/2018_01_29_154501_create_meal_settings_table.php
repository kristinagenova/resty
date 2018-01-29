<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealSettingsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('meal_settings', function (Blueprint $table) {
            $table->increments('meal_setting_id');
            $table->integer('user_id');
            $table->integer('hour'); // when is my meal - the main and most important field that would be adjusted with the ML
            $table->integer('minute'); // when is my meal - the main and most important field that would be adjusted with the ML
            $table->integer('notification_time'); // in minutes before meal
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_settings');
    }
}
