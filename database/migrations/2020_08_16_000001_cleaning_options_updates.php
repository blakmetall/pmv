<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CleaningOptionsUpdates extends Migration
{
    public function up()
    {
        if (Schema::hasTable('properties')) {
            if (!Schema::hasColumn('properties', 'cleaning_staff_ids')) {
                Schema::table('properties', function ($table) {
                    $table->text('cleaning_staff_ids')->nullable()->after('maid_fee');
                });
            }
        }

        if (Schema::hasTable('human_resources')) {
            if (!Schema::hasColumn('human_resources', 'is_cleaning_staff')) {
                Schema::table('human_resources', function ($table) {
                    $table->integer('is_cleaning_staff')->nullable()->default(0)->after('children');
                });
            }
        }
    }

    public function down()
    {
        if (Schema::hasTable('properties')) {
            if (Schema::hasColumn('properties', 'cleaning_staff_ids')) {
                Schema::table('properties', function ($table) {
                    $table->dropColumn('cleaning_staff_ids');
                });
            }
        }

        if (Schema::hasTable('human_resources')) {
            if (Schema::hasColumn('human_resources', 'is_cleaning_staff')) {
                Schema::table('human_resources', function ($table) {
                    $table->dropColumn('is_cleaning_staff');
                });
            }
        }
    }
}
