<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePropertiesTranslationsTableRemoveCancellationPolicies extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('properties_translations')) {
            return;
        }

        if(Schema::hasColumn('properties_translations', 'cancellation_policies')) {
            Schema::table('properties_translations', function (Blueprint $table) {
                $table->dropColumn('cancellation_policies');
            });
        }
    }
    
    public function down()
    {
        if(!Schema::hasColumn('properties_translations', 'bedding_notes')) {
            Schema::table('properties_translations', function (Blueprint $table) {
                $table->text('cancellation_policies')->nullable()->after('description');
            });
        }
    }
}
