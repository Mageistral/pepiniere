<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RootstocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $table->string('name');
        // $table->string('name_alternate');
        // $table->float('height_max_noticed');
        // $table->float('height_min_noticed');

        // $table->timestamps();

        DB::table('rootstocks')->insert([
            'name' => 'Prunier Myrobalan',
            'name_alternate' => null,
            'height_mean' => 500,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('rootstocks')->insert([
            'name' => "Franc d'amandier",
            'name_alternate' => null,
            'height_mean' => 500,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
        DB::table('rootstocks')->insert([
            'name' => "Franc d'abricotier",
            'name_alternate' => null,
            'height_mean' => 400,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
