<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePropertyNotesAddAuditControls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('property_notes')) {
            return;
        }

        Schema::table('property_notes', function (Blueprint $table) {
            $table->tinyInteger('is_finished')->nullable()->default(0)->after('description');
            $table->integer('audit_user_id')->nullable()->after('is_finished');
            $table->dateTime('audit_datetime')->nullable()->after('audit_user_id');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_notes', function($table) {
            $table->dropColumn('is_finished');
            $table->dropColumn('audit_user_id');
            $table->dropColumn('audit_datetime');
        });
    }
}
