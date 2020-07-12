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
        $this->call(LevelsSeeder::class);
        $this->call(RegionsSeeder::class);
        $this->call(SpecificitiesCategoriesSeeder::class);
        $this->call(SpecificitiesSeeder::class);
        $this->call(FruitsSeeder::class);
        $this->call(RootstocksSeeder::class);
    }
}
