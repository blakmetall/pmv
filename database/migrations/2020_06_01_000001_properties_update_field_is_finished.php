<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PropertiesUpdateFieldIsFinished extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('property_management')) {
            return;
        }

        Schema::table('property_management', function (Blueprint $table) {
            $table->tinyInteger('is_finished')->nullable()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_management', function($table) {
            $table->tinyInteger('is_finished')->nullable()->change();
        });
    }
}
