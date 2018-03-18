<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->date('actual_notification_time')->default('');
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
