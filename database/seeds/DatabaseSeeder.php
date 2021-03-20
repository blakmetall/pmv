<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AmenitiesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(CleaningOptionsTableSeeder::class);
        $this->call(DamageDepositsTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(ProfilesConfigRoleIdSeeder::class);
        $this->call(PropertyTypesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(TransactionTypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ZonesTableSeeder::class);
        $this->call(BuildingsTableSeeder::class);
    }
}
