<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todo')->insert([
            'title' => Str::random(),
            'is_completed' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('todo')->insert(([
            'title' => 'study',
            'is_completed' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]));
    }
}
