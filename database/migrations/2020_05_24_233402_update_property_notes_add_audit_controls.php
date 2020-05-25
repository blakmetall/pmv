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

        Schema::table('property_notes', function (Blueprint $table) {
            $table->tinyInteger('is_finished')->nullable()->default(0)->after('description');
            $table->dateTime('audit_datetime')->nullable()->after('is_finished');
            $table->integer('audit_user_id')->nullable()->after('audit_datetime');
            $table->text('notes')->nullable()->after('audit_user_id');
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
            $table->dropColumn('audit_datetime');
            $table->dropColumn('audit_datetime');
            $table->dropColumn('notes');
        });
    }
}
