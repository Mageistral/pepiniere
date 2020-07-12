<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecificitiesCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specificities_categories')->insert([
            'id' => 1,
            'name' => "Climat",
            'description' => "Caractéristiques liées aux conditions climatiques.",
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        DB::table('specificities_categories')->insert([
            'id' => 2,
            'name' => "Sol",
            'description' => "Caractéristiques liées à celles du sol.",
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        DB::table('specificities_categories')->insert([
            'id' => 3,
            'name' => "Maladies",
            'description' => "Caractéristiques liées à la résistance ou sensibilité aux maladies.",
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
