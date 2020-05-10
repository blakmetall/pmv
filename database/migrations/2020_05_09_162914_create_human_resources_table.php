<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHumanResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('human_resources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('city_id');
            $table->string('address');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('department')->nullable();
            $table->date('entry_at')->nullable();
            $table->date('birthday')->nullable();
            $table->date('vacations_start_at')->nullable();
            $table->date('vacations_end_at')->nullable();
            $table->integer('days_vacations')->nullable();
            $table->integer('children')->nullable();
            $table->tinyInteger('is_active')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('human_resources');
    }
}
