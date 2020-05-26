<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePropertyManagementTransactionsAddTypeCreditDebit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_management_transactions', function (Blueprint $table) {
            $table->string('payment_type', 30)->nullable()->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_management_transactions', function($table) {
            $table->dropColumn('payment_type');
        });
    }
}
