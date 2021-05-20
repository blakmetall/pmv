<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHumanResourcesPhones extends Migration
{
    public function up()
    {
        if (Schema::hasTable('human_resources')) {
            Schema::table('human_resources', function ($table) {
                $table->string('phone')->nullable()->default('');
                $table->string('emergency_phone')->nullable()->default('');
                $table->string('mobile')->nullable()->default('');
            });
        }
    }
    
    public function down()
    {
        if (Schema::hasTable('human_resources')) {
            Schema::table('human_resources', function ($table) {
                $table->dropColumn('phone');
                $table->dropColumn('emergency_phone');
                $table->dropColumn('mobile');
            });
        }
    }
}
