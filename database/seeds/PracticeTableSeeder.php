<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PracticeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run():void
    {
        DB::table('practice')->insert([
            'name' => Str::random(5),
            'number' => rand(10000,99999),
            'free' => Str::random(8),
        ]);
        DB::table('practice')->insert([
            'name' => Str::random(5),
            'number' => rand(10000,99999),
            'free' => Str::random(8),
        ]);
    }
}
