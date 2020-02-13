<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('booking_commissions')) {
            return;
        }

        Schema::create('booking_commissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('booking_id');
            $table->tinyInteger('is_commission_paid')->nullable()->default(0);
            $table->decimal('commission_amount', 15, 2)->nullable();
            $table->decimal('commission_percentage', 5, 2)->nullable();
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
        Schema::dropIfExists('booking_commissions');
    }
}
