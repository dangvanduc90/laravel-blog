<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('roles')->insert([
                'name' => str_random(),
                'slug' => str_random(),
                'permission' => rand(1, 10)
            ]);
        }
    }
}
