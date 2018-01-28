<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->integer('restaurant_id');
            $table->string('name');
            $table->string('url');
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('country_id');
            $table->string('cuisine')->default('');
            $table->float('average_cost')->nullable();
            $table->float('price_range')->nullable();
            $table->float('aggregate_rating')->nullable();
            $table->string('rating_text')->default('');
            $table->integer('votes')->nullable();
            $table->string('photos_url')->nullable();
            $table->string('menu_url')->nullable();
            $table->string('featured_img')->nullable();
            $table->integer('online_delivery')->nullable();
            $table->integer('table_booking')->nullable();

            $table->primary('restaurant_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
