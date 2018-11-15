<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 80; $i++) {
            DB::table('posts')->insert([
                'user_id' => rand(1, 50) . "",
                'title' => str_random(10),
            ]);
        }
    }
}
