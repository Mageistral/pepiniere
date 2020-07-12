<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            'name' => "Total(e)",
            'weight' => 100,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        DB::table('levels')->insert([
            'name' => "Bon(ne)",
            'weight' => 80,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        DB::table('levels')->insert([
            'name' => "Plus que la moyenne",
            'weight' => 60,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        DB::table('levels')->insert([
            'name' => "Moyen(ne)",
            'weight' => 50,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        DB::table('levels')->insert([
            'name' => "Moins que la moyenne",
            'weight' => 40,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        DB::table('levels')->insert([
            'name' => "Mauvais(e)",
            'weight' => 20,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        DB::table('levels')->insert([
            'name' => "Néant(e)",
            'weight' => 0,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
