<?php

use Illuminate\Database\Seeder;

class ZonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $exists = DB::table('zones')->first();

        if(!$exists){

            $json = File::get("database/data/zones.json");
            $data = json_decode($json);

            foreach ($data as $obj) {

                // insert zone
                $zone_id = DB::table('zones')->insertGetId([
                    'id' => $obj->id,
                    'city_id' => $obj->city_id
                ]);

                // insert zones translations
                foreach($obj->translations as $translation) {
                    DB::table('zones_translations')->insertGetId([
                        'language_id' => $translation->language_id,
                        'zone_id' => $zone_id,
                        'name' => $translation->name
                    ]);
                }

            }
        }

    }
}
