<?php

use Illuminate\Database\Seeder;

class DamageDepositsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $exists = DB::table('damage_deposits')->first();

        if(!$exists){

            $json = File::get("database/data/damage_deposits.json");
            $data = json_decode($json);

            foreach ($data as $obj) {

                // insert damage deposit option
                $damage_deposit_id = DB::table('damage_deposits')->insertGetId([
                    'id' => $obj->id,
                    'price' => $obj->price,
                    'is_refundable' => $obj->is_refundable
                ]);

                // insert damage_deposits translations
                foreach($obj->translations as $translation) {
                    DB::table('damage_deposits_translations')->insertGetId([
                        'language_id' => $translation->language_id,
                        'damage_deposit_id' => $damage_deposit_id,
                        'description' => $translation->description
                    ]);
                }

            }
        }

    }
}
