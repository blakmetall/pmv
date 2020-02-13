<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $exists = DB::table('states')->first();

        if(!$exists){

            $json = File::get("database/data/states.json");
            $data = json_decode($json);

            foreach ($data as $obj) {

                // insert state
                $state_id = DB::table('states')->insertGetId([
                    'id' => $obj->id,
                    'name' => $obj->name
                ]);

            }
        }

    }
}
