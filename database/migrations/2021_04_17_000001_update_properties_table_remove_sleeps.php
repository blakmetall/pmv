<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePropertiesTableRemoveSleeps extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('properties')) {
            return;
        }

        Schema::create('properties', function (Blueprint $table) {
            $table->dropColumn('sleeps');
        });
    }

    public function down()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->smallInteger('sleeps')->nullable()->after('baths');
        });
    }
}
