<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorsServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('contractors_services')) {
            return;
        }

        Schema::create('contractors_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contractor_id');
            $table->decimal('base_price', 15, 2)->nullable();
            $table->decimal('previous_base_price', 15, 2)->nullable();
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
        Schema::dropIfExists('contractors_services');
    }
}
