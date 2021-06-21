<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHumanResourcesTableAddFields extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('human_resources')) {
            return;
        }

        if(!Schema::hasColumn('human_resources', 'position')) {
            Schema::table('human_resources', function (Blueprint $table) {
                $table->string('position')->nullable()->after('department');
                $table->string('scholarship')->nullable()->after('birthday');
                $table->text('notes')->nullable()->after('birthday');
            });
        }
    }
    
    public function down()
    {
        if(Schema::hasColumn('human_resources', 'position')) {
            Schema::table('human_resources', function (Blueprint $table) {
                $table->dropColumn('position');
                $table->dropColumn('scholarship');
                $table->dropColumn('notes');
            });
        }
    }
}
