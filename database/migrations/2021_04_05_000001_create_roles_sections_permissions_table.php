<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesSectionsPermissionsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('roles_sections_permissions')) {
            return;
        }

        Schema::create('roles_sections_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->string('section_slug', 191)->nullable();
            $table->string('section_name', 191)->nullable();
        });
    }

    public function down()
    {
        $table->dropIfExists('roles_sections_permissions');
    }
}
