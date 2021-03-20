<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('bookings')) {
            return;
        }

        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id');
            $table->integer('user_id');
            $table->integer('reservation_request_id')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('zip', 10)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('mobile', 30)->nullable();
            $table->text('comments')->nullable();
            $table->string('arrival_airline')->nullable();
            $table->string('arrival_flight_number')->nullable();
            $table->string('arrival_time')->nullable();
            $table->string('departure_airline')->nullable();
            $table->string('departure_flight_number')->nullable();
            $table->string('departure_time')->nullable();
            $table->dateTime('audit_datetime')->nullable();
            $table->integer('audit_user_id')->nullable();
            $table->decimal('price_per_night', 15, 2)->nullable();
            $table->string('price_rate_type', 10)->nullable();
            $table->smallInteger('nights')->nullable();
            $table->decimal('subtotal_nights', 15, 2)->nullable();
            $table->decimal('subtotal_damage_deposit', 15, 2)->nullable();
            $table->integer('damage_deposit_id');
            $table->decimal('total', 15, 2)->nullable();
            $table->smallInteger('adults')->nullable();
            $table->smallInteger('kids')->nullable();
            $table->tinyInteger('is_refundable')->nullable()->default(0);
            $table->tinyInteger('is_property_damaged')->nullable()->default(0);
            $table->dateTime('audit_refund_datetime')->nullable();
            $table->integer('audit_refund_user_id')->nullable();
            $table->tinyInteger('is_cancelled')->nullable()->default(0);
            $table->tinyInteger('is_paid')->nullable()->default(0);
            $table->tinyInteger('is_finished')->nullable()->default(0);
            $table->tinyInteger('payment_is_manual')->nullable()->default(0);
            $table->string('payment_transaction_ID')->nullable();
            $table->text('payment_description')->nullable();
            $table->dateTime('payment_datetime')->nullable();
            $table->string('payment_status')->nullable();
            $table->text('payment_data_JSON')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
