<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyManagementPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('property_management_payments')) {
            return;
        }

        Schema::create('property_management_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_management_id');
            $table->smallInteger('year');
            $table->smallInteger('month');
            $table->text('description')->nullable();
            $table->decimal('total', 15, 2)->nullable();
            $table->tinyInteger('is_paid')->nullable()->default(0);
            $table->tinyInteger('payment_is_manual')->nullable()->default(0);
            $table->string('payment_transaction_ID')->nullable();
            $table->text('payment_description')->nullable();
            $table->dateTime('payment_datetime')->nullable();
            $table->string('payment_status')->nullable();
            $table->text('payment_data_JSON')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('property_management_payments');
    }
}
