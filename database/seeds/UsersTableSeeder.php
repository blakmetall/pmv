<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $exists = DB::table('users')->first();

        if(!$exists){

            $json = File::get("database/data/users.json");
            $data = json_decode($json);

            foreach ($data as $obj) {

                // insert user
                $user_id = DB::table('users')->insertGetId([
                    'id' => $obj->id,
                    'email' => $obj->email,
                    'email_verified_at' => $obj->email_verified_at,
                    'password' => Hash::make($obj->password),
                    'is_enabled' => $obj->is_enabled,
                    'created_at' => '2020-01-01 00:00:00',
                    'updated_at' => '2020-01-01 00:00:00'
                ]);

                // insert user profile information
                $profile_id = DB::table('profiles')->insertGetId([
                    'user_id' => $user_id,
                    'firstname' => $obj->profile->firstname,
                    'lastname' => $obj->profile->lastname,
                    'country' => $obj->profile->country,
                    'state' => $obj->profile->state,
                    'city' => $obj->profile->city,
                    'street' => $obj->profile->street,
                    'zip' => $obj->profile->zip,
                    'phone' => $obj->profile->phone,
                    'mobile' => $obj->profile->mobile,
                    'config_role_id' => $obj->profile->config_role_id,
                    'config_language' => $obj->profile->config_language,
                    'created_at' => '2020-01-01 00:00:00',
                    'updated_at' => '2020-01-01 00:00:00'
                ]);

                // attach roles
                $role_relation_id = DB::table('user_has_roles')->insertGetId([
                    'user_id' => $user_id,
                    'role_id' => $obj->user_role_id
                ]);

                // attach staff groups (locations permissions from puerto vallarta and mazatlan)
                foreach($obj->cities_staff_groups as $staff_group) {
                    DB::table('staff_groups')->insertGetId([
                        'user_id' => $user_id,
                        'city_id' => $staff_group->city_id,
                        'location' => $staff_group->location
                    ]);
                }

            }
        }

    }
}
