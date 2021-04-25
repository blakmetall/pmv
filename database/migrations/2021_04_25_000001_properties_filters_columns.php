<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PropertiesFiltersColumns extends Migration
{
    public function up()
    {
        if (Schema::hasTable('properties')) {
            Schema::table('properties', function ($table) {
                $table->integer('pet_friendly')->nullable()->default(0)->after('is_special');
                $table->integer('adults_only')->nullable()->default(0)->after('is_special');
                $table->integer('beachfront')->nullable()->default(0)->after('is_special');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('properties') && Schema::hasColumn('properties', 'average_month')) {
            Schema::table('properties', function ($table) {
                $table->dropColumn('pet_friendly');
                $table->dropColumn('adults_only');
                $table->dropColumn('beachfront');
            });
        }
    }
}
