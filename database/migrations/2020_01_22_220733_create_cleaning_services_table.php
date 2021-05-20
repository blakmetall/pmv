<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCleaningServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('cleaning_services')) {
            return;
        }

        Schema::create('cleaning_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->integer('cleaning_staff_id')->nullable();
            $table->integer('property_management_transaction_id')->nullable();
            $table->integer('booking_id')->nullable();
            $table->date('date')->nullable();
            $table->time('hour')->nullable();
            $table->text('description')->nullable();
            $table->decimal('maid_fee', 15, 2)->nullable();
            $table->tinyInteger('is_finished')->nullable()->default(0);
            $table->dateTime('audit_datetime')->nullable();
            $table->integer('audit_user_id')->nullable();
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
        Schema::dropIfExists('cleaning_services');
    }
}
