<?php

use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            DB::table('videos')->insert([
                'title' => str_random(10),
                'url' => str_random(10),
            ]);
        }
    }
}
