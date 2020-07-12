<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FruitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fruits')->insert([
            'name' => 'abricot',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('fruits')->insert([
            'name' => 'amande',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('fruits')->insert([
            'name' => 'cerise',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('fruits')->insert([
            'name' => 'pêche',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('fruits')->insert([
            'name' => 'poire',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('fruits')->insert([
            'name' => 'pomme',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('fruits')->insert([
            'name' => 'prune',
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
