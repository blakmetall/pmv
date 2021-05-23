<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePropertiesTableAddBeddingNotesField extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('properties')) {
            return;
        }

        if(!Schema::hasColumn('properties', 'bedding_notes')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->text('bedding_notes')->nullable()->after('bedding');
            });
        }
    }
    
    public function down()
    {
        if(Schema::hasColumn('properties', 'bedding_notes')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->dropColumn('bedding_notes');
            });
        }
    }
}
