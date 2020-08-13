<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('properties')) {
            return;
        }

        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->integer('zone_id');
            $table->integer('building_id')->nullable();
            $table->integer('property_type_id');
            $table->integer('cleaning_option_id');
            $table->tinyInteger('is_featured')->nullable()->default(0);
            $table->tinyInteger('is_enabled')->nullable()->default(0);
            $table->tinyInteger('is_online')->nullable()->default(0);
            $table->decimal('rental_commission', 5, 2)->nullable();
            $table->decimal('maid_fee', 15, 2)->nullable();
            $table->smallInteger('bedrooms')->nullable();
            $table->text('bedding_JSON')->nullable();
            $table->decimal('baths', 5, 1)->nullable();
            $table->smallInteger('sleeps')->nullable();
            $table->smallInteger('floors')->nullable();
            $table->tinyInteger('has_parking')->nullable();
            $table->decimal('lot_size_sqft', 15, 2)->nullable();
            $table->decimal('construction_size_sqft', 15, 2)->nullable();
            $table->string('phone', 30)->nullable();
            $table->text('address')->nullable();
            $table->string('gmaps_lat', 30)->nullable();
            $table->string('gmaps_lon', 30)->nullable();
            $table->tinyInteger('register_completed')->nullable();
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
        Schema::dropIfExists('properties');
    }
}
