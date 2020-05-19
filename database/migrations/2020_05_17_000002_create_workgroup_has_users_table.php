<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkgroupHasUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('workgroup_has_users')) {
            return;
        }

        Schema::create('workgroup_has_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('workgroup_id');
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workgroup_has_users');
    }
}
