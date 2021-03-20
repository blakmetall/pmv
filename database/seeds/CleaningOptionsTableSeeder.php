<?php

use Illuminate\Database\Seeder;

class CleaningOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $exists = DB::table('cleaning_options')->first();

        if(!$exists){

            $json = File::get("database/data/cleaning_options.json");
            $data = json_decode($json);

            foreach ($data as $obj) {

                // insert cleaning option
                $cleaning_option_id = DB::table('cleaning_options')->insertGetId([
                    'id' => $obj->id
                ]);

                // insert cleaning_options translations
                foreach($obj->translations as $translation) {
                    DB::table('cleaning_options_translations')->insertGetId([
                        'language_id' => $translation->language_id,
                        'cleaning_option_id' => $cleaning_option_id,
                        'name' => $translation->name
                    ]);
                }

            }
        }

    }
}
