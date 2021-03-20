<?php

use Illuminate\Database\Seeder;

class BuildingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $exists = DB::table('buildings')->first();

        if (!$exists) {

            $json = File::get("database/data/buildings.json");
            $data = json_decode($json);

            foreach ($data as $obj) {

                // insert building
                $building_id = DB::table('buildings')->insertGetId([
                    'id' => $obj->id,
                    'name' => $obj->name,
                    'description' => $obj->description
                ]);
            }
        }
    }
}
