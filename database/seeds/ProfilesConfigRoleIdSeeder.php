<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProfilesConfigRoleIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $exists = DB::table('profiles')->first();

        if ($exists && $this->hasRoleColumn() && !$this->randomUserHasConfigRoleId()) {

            $users = \App\Models\User::get();

            if($users->count()) {
                foreach($users as $user) {
                    if($user->profile) {
                        $role = $user->roles()->first();
                        if($role) {
                            $user->profile->config_role_id = $role->id;
                            $user->profile->save();
                        }
                    }
                }
            }
            
        }
    }

    /**
     * Checks if table has role column
     */
    private function hasRoleColumn() {
        return Schema::hasColumn('profiles', 'config_role_id');
    }

    /**
     * Verifies if a random user has the config_role_id
     *  
     * @return bool
     */
    private function randomUserHasConfigRoleId() {
        $randomUser = \App\Models\Profile::inRandomOrder()->first();

        $hasValue = !! $randomUser->config_role_id;

        return ($hasValue);
    }

}
