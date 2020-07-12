<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
            'name' => "Europe - Sud-Est"
        ]);
        DB::table('regions')->insert([
            'name' => "Asie - Sud-Ouest"
        ]);
        DB::table('regions')->insert([
            'name' => "Russie"
        ]);
    }
}
