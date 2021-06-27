<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBookingsTableAddAlternateEmail extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('property_bookings')) {
            return;
        }

        if(!Schema::hasColumn('property_bookings', 'alternate_email')) {
            Schema::table('property_bookings', function (Blueprint $table) {
                $table->string('alternate_email')->nullable()->after('email');
            });
        }
    }
    
    public function down()
    {
        if(Schema::hasColumn('property_bookings', 'alternate_email')) {
            Schema::table('property_bookings', function (Blueprint $table) {
                $table->dropColumn('alternate_email');
            });
        }
    }
}
