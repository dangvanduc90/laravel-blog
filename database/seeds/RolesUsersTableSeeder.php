<?php

use Illuminate\Database\Seeder;

class RolesUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('role_users')->insert([
                'user_id' => rand(1, 50),
                'role_id' => rand(1, 10)
            ]);
        }
    }
}
