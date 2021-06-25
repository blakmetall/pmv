<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBookingsTableAddFields extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('property_bookings')) {
            return;
        }

        if(!Schema::hasColumn('property_bookings', 'arrival_notes')) {
            Schema::table('property_bookings', function (Blueprint $table) {
                $table->string('arrival_notes')->nullable()->after('check_out');
                $table->string('departure_notes')->nullable()->after('check_out');
                $table->text('concierge_notes')->nullable()->after('check_out');
            });
        }
    }
    
    public function down()
    {
        if(Schema::hasColumn('property_bookings', 'position')) {
            Schema::table('property_bookings', function (Blueprint $table) {
                $table->dropColumn('arrival_notes');
                $table->dropColumn('departure_notes');
                $table->dropColumn('concierge_notes');
            });
        }
    }
}
