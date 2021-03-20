<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCleaningServicesHasCleaningStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('cleaning_services_has_cleaning_staff')) {
            return;
        }

        Schema::create('cleaning_services_has_cleaning_staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cleaning_service_id');
            $table->integer('cleaning_staff_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cleaning_services_has_cleaning_staff');
    }
}
