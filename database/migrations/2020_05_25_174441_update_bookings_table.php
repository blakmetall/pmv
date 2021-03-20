<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('property_bookings')) {
            return;
        }

        Schema::table('property_bookings', function (Blueprint $table) {
            $table->date('arrival_date')->nullable()->after('arrival_airline');
            $table->date('departure_date')->nullable()->after('departure_airline');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_bookings', function ($table) {
            $table->dropColumn('arrival_date');
            $table->dropColumn('departure_date');
        });
    }
}
