<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DbVariousUpdates extends Migration
{
    public function up()
    {
        if (Schema::hasTable('property_management_transactions') && Schema::hasColumn('property_management_transactions', 'is_paid')) {
            Schema::table('property_management_transactions', function ($table) {
                $table->dropColumn('is_paid');
            });
        }

        if (Schema::hasTable('property_management')) {
            if (!Schema::hasColumn('property_management', 'average_month')) {
                Schema::table('property_management', function ($table) {
                    $table->decimal('average_month', 15, 2)->nullable()->default(0)->after('end_date');
                });
            }

            if (Schema::hasColumn('property_management', 'property_management_payment_id')) {
                Schema::table('property_management', function ($table) {
                    $table->dropColumn('property_management_payment_id');
                });
            }
        }

        if (Schema::hasTable('profiles') && !Schema::hasColumn('profiles', 'config_agent_is_enabled')) {
            Schema::table('profiles', function ($table) {
                $table->tinyInteger('config_agent_is_enabled')->nullable()->default(0)->after('config_agent_commission');
            });
        }

        if (Schema::hasTable('property_bookings') && !Schema::hasColumn('property_bookings', 'user_agent_id')) {
            Schema::table('property_bookings', function ($table) {
                $table->tinyInteger('user_agent_id')->nullable()->after('reservation_request_id');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('property_management_transactions') && !Schema::hasColumn('property_management_transactions', 'is_paid')) {
            Schema::table('property_management_transactions', function ($table) {
                $table->date('is_paid')->nullable()->after('file_url');
            });
        }

        if (Schema::hasTable('property_management') && Schema::hasColumn('property_management', 'average_month')) {
            Schema::table('property_management', function ($table) {
                $table->dropColumn('average_month');
            });
        }

        if (Schema::hasTable('profiles') && Schema::hasColumn('profiles', 'config_agent_is_enabled')) {
            Schema::table('profiles', function ($table) {
                $table->dropColumn('config_agent_is_enabled');
            });
        }
    }
}
