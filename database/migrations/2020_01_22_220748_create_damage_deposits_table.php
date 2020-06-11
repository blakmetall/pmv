<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDamageDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('damage_deposits')) {
            return;
        }

        Schema::create('damage_deposits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price', 15, 2)->nullable();
            $table->tinyInteger('is_refundable')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('damage_deposits');
    }
}
