<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbAddTransactionUpdatedByAndCreatedBy extends Migration
{
    public function up()
    {
        if (Schema::hasTable('property_management_transactions')) {
            Schema::table('property_management_transactions', function($table) {
                $table->unsignedBigInteger('created_by')->nullable()->after('audit_user_id');
                $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('property_management_transactions')) {
            Schema::table('property_management_transactions', function($table) {
                $table->dropColumn(['created_by', 'updated_by']);
            });
        }
    }
}
