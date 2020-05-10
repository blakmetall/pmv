<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CleaningServicesRemoveCleaningStaffId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('cleaning_services')) {
            return;
        }

        Schema::table('cleaning_services', function (Blueprint $table) {
            Schema::table('cleaning_services', function (Blueprint $table) {
                $table->dropColumn(['cleaning_staff_id']);
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (! Schema::hasTable('cleaning_services')) {
            return;
        }

        $table->integer('cleaning_staff_id')
                ->after('property_id')
                ->nullable();
    }
}
