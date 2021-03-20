<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyManagementTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('property_management_transactions')) {
            return;
        }

        Schema::create('property_management_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_management_id');
            $table->integer('transaction_type_id')->nullable();
            $table->integer('property_management_payment_id')->nullable();
            $table->integer('contractor_service_id')->nullable();
            $table->date('period_start_date')->nullable();
            $table->date('period_end_date')->nullable();
            $table->date('post_date')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->string('file_slug')->nullable();
            $table->string('file_extension')->nullable();
            $table->string('file_original_name')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_url')->nullable();
            $table->tinyInteger('is_paid')->nullable()->default(0);
            $table->date('audit_date')->nullable();
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
        Schema::dropIfExists('property_management_transactions');
    }
}
