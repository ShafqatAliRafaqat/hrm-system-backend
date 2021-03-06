<?php

namespace Database\Seeders;

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
        $this->call(RoleTableSeeder::class);
        \App\Models\User::factory(10)->create();
        $this->call(CountryTableSeeder::class);
        $this->call(ColumnSelectSeeder::class);
        
        // $this->call(GregHijriActualTableSeeder::class);
        // $this->call(GregHijriActual2TableSeeder::class);
        $this->call(HijriDateTableSeeder::class);
    }
}
