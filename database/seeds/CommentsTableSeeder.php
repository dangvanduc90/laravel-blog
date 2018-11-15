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
        $input = ["App\Video", "App\Post"];
        for ($i = 0; $i < 80; $i++) {
            $rand_keys = array_rand($input);
            DB::table('comments')->insert([
                'body' => str_random(50),
                'commentable_id' => rand(1, 50),
                'commentable_type' => $input[$rand_keys],
            ]);
        }
    }
}
