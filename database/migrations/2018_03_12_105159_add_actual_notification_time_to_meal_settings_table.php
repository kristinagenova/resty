<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActualNotificationTimeToMealSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("meal_settings", function (Blueprint $table){
            $table->integer('actual_notification_time')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("meal_settings", function (Blueprint $table){
            $table->dropColumn("actual_notification_time");
        });
    }
}
