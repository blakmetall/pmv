<?php

use Illuminate\Database\Seeder;

class AmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $exists = DB::table('amenities')->first();

        if(!$exists){

            $json = File::get("database/data/amenities.json");
            $data = json_decode($json);

            foreach ($data as $obj) {

                // insert amenity
                $amenity_id = DB::table('amenities')->insertGetId([
                    'id' => $obj->id
                ]);

                // insert amenities translations
                foreach($obj->translations as $translation) {
                    DB::table('amenities_translations')->insertGetId([
                        'language_id' => $translation->language_id,
                        'amenity_id' => $amenity_id,
                        'name' => $translation->name
                    ]);
                }

            }
        }

    }
}
