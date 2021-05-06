<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePropertiesTableAddBeddingField extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('properties')) {
            return;
        }

        if(!Schema::hasColumn('properties', 'bedding')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->text('bedding')->nullable()->after('pax');
            });
        }
    }
    
    public function down()
    {
        if(Schema::hasColumn('properties', 'bedding')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->dropColumn('bedding');
            });
        }
    }
}
