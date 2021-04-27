<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRolesSectionsPermissions extends Migration
{
    public function up()
    {
        if (Schema::hasTable('roles_sections_permissions')) {
            return;
        }

        Schema::create('roles_sections_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('section_slug')->nullable();
            $table->string('section_name')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasTable('roles_sections_permissions')) {
            $table->dropColumn('roles_sections_permissions');
        }
    }
}
