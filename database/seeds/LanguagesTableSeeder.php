<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $exists = DB::table('languages')->first();

        if(!$exists){

            $json = File::get("database/data/languages.json");
            $data = json_decode($json);

            foreach ($data as $obj) {

                // insert language
                $language_id = DB::table('languages')->insertGetId([
                    'id' => $obj->id,
                    'name' => $obj->name,
                    'slug' => $obj->slug,
                    'code' => $obj->code
                ]);

            }
        }

    }
}
