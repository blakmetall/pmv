<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('property_rates')) {
            return;
        }

        Schema::create('property_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('nightly', 15, 2)->nullable(); // usd
            $table->decimal('weekly', 15, 2)->nullable(); // usd
            $table->decimal('monthly', 15, 2)->nullable(); // usd
            $table->smallInteger('min_stay')->nullable();
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
        Schema::dropIfExists('property_rates');
    }
}
