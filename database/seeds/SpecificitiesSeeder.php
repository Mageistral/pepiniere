<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecificitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specificities')->insert([
            'name' => "Tolère les étés chauds et secs",
            'description' => "explication ete sec.",
            'category_id' => 1,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        DB::table('specificities')->insert([
            'name' => "Tolère les sols lourds",
            'description' => "expli sol lourd.",
            'category_id' => 2,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        DB::table('specificities')->insert([
            'category_id' => 3,
            'name' => "Résiste au chancre bactérien",
            'description' => "expl chancre.",
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
