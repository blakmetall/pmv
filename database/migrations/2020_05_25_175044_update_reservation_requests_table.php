<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateReservationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservation_requests', function (Blueprint $table) {
            $table->date('arrival_date')->nullable()->after('arrival_airline');
            $table->date('departure_date')->nullable()->after('departure_airline');
            $table->time('arrival_time')->nullable()->change();
            $table->time('departure_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservation_requests', function($table) {
            $table->dropColumn('arrival_date');
            $table->dropColumn('departure_date');
            $table->dropColumn('arrival_time');
            $table->dropColumn('departure_time');
        });
    }
}
