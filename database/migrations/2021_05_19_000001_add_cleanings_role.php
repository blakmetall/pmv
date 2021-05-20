<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCleaningsRole extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('roles') && !Schema::hasTable('roles')) {
            return;
        }

        // insert new role
        DB::table('roles')->insert(array('id' => '14'));
        
        // inser new role translations
        DB::table('roles_translations')->insert(
            array('language_id' => 1, 'role_id' => 14, 'name' => 'Cleanings Manager')
        );

        // inser new role translations
        DB::table('roles_translations')->insert(
            array('language_id' => 2, 'role_id' => 14, 'name' => 'Gerente de limpiezas')
        );
    }
    
    public function down()
    {
        DB::table('roles')->where('id', 14)->delete();

        DB::table('roles_translations')
            ->where('language_id', 1)
            ->where('role_id', 14)
            ->delete();

            DB::table('roles_translations')
            ->where('language_id', 2)
            ->where('role_id', 14)
            ->delete();
    }
}
