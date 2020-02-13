<?php

use Illuminate\Database\Seeder;

class PropertyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $exists = DB::table('property_types')->first();

        if(!$exists){

            $json = File::get("database/data/property_types.json");
            $data = json_decode($json);

            foreach ($data as $obj) {

                // insert property type
                $property_type_id = DB::table('property_types')->insertGetId([
                    'id' => $obj->id
                ]);

                // insert property_types translations
                foreach($obj->translations as $translation) {
                    DB::table('property_types_translations')->insertGetId([
                        'language_id' => $translation->language_id,
                        'property_type_id' => $property_type_id,
                        'name' => $translation->name
                    ]);
                }

            }
        }

    }
}
