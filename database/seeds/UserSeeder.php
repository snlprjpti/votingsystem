<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $rows = [
            [
                'name' => 'Admin',
                'email' => 'a@a.com',
                'password' => bcrypt('a'),
                'type' => 'admin'
            ],
            [
                'name' => 'organizer',
                'email' => 'o@o.com',
                'password' => bcrypt('o'),
                'type' => 'org'
            ],
            [
                'name' => 'Voter',
                'email' => 'v@v.com',
                'password' => bcrypt('v'),
                'type' => 'voter'
            ],
        ];
        DB::table('users')->insert($rows);
    }
}
