<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $exists = DB::table('cities')->first();

        if(!$exists){

            $json = File::get("database/data/cities.json");
            $data = json_decode($json);

            foreach ($data as $obj) {

                // insert city
                $city_id = DB::table('cities')->insertGetId([
                    'id' => $obj->id,
                    'state_id' => $obj->state_id,
                    'name' => $obj->name
                ]);

            }
        }

    }
}
