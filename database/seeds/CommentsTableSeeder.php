<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'user_id' => 1,
            'movie_id' => 1,
            'comment' => 'おはよう',
        ]);
        DB::table('comments')->insert([
            'user_id' => 2,
            'movie_id' => 1,
            'comment' => 'こんにちは',
        ]);
        DB::table('comments')->insert([
            'user_id' => 3,
            'movie_id' => 2,
            'comment' => 'こんばんは',
        ]);
        DB::table('comments')->insert([
            'user_id' => 4,
            'movie_id' => 2,
            'comment' => 'おやすみ',
        ]);
    }
}
