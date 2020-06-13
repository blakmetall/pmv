<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbVariousUpdates extends Migration
{
    public function up()
    {
        if (Schema::hasTable('property_management_transactions')) {
            Schema::table('property_management_transactions', function($table) {
                $table->dropColumn('is_paid');
            });
        }

        if (Schema::hasTable('property_management')) {
            Schema::table('property_management', function($table) {
                $table->decimal('average_month', 15, 2)->nullable()->default(0)->after('end_date');
            });
            
            Schema::table('property_management', function($table) {
                $table->dropColumn('property_management_payment_id');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('property_management_transactions')) {
            Schema::table('property_management_transactions', function($table) {
                $table->date('is_paid')->nullable()->after('file_url');
            });
        }

        if (Schema::hasTable('property_management')) {
            Schema::table('property_management', function($table) {
                $table->dropColumn('average_month');
            });
        }
    }
}
