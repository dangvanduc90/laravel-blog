<?php

use Illuminate\Database\Seeder;

class PhonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            DB::table('phones')->insert([
                'number' => rand((int) 1000000000, (int) 9999999999),
                'user_id' => $i + 1
            ]);
        }
    }
}
