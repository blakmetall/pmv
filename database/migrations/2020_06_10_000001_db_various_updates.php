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

    }

    public function down()
    {
        if (Schema::hasTable('property_management_transactions')) {
            Schema::table('property_management_transactions', function($table) {
                $table->date('is_paid')->nullable()->after('file_url');
            });
        }
    }
}
