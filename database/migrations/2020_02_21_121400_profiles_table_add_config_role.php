<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProfilesTableAddConfigRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('profiles')) {
            return;
        }

        Schema::table('profiles', function (Blueprint $table) {
            $table->integer('config_role_id')
                ->after('mobile') // after mobile column
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (! Schema::hasTable('profiles')) {
            return;
        }

        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['config_role_id']);
        });
    }
}
