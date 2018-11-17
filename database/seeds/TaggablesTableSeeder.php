<?php

use Illuminate\Database\Seeder;

class TaggablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = ["App\Video", "App\Post"];
        for ($i = 0; $i < 50; $i++) {
            $rand_keys = array_rand($input);
            DB::table('taggables')->insert([
                'taggable_id' => rand(1, 50),
                'taggable_type' => $input[$rand_keys],
            ]);
        }
    }
}
