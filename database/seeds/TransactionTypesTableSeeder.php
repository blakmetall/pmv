<?php

use Illuminate\Database\Seeder;

class TransactionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $exists = DB::table('transaction_types')->first();

        if(!$exists){

            $json = File::get("database/data/transaction_types.json");
            $data = json_decode($json);

            foreach ($data as $obj) {

                // insert transaction types
                $transaction_type_id = DB::table('transaction_types')->insertGetId([
                    'id' => $obj->id
                ]);

                // insert transaction types translations
                foreach($obj->translations as $translation) {
                    DB::table('transaction_types_translations')->insertGetId([
                        'language_id' => $translation->language_id,
                        'transaction_type_id' => $transaction_type_id,
                        'name' => $translation->name
                    ]);
                }

            }
        }

    }
}
