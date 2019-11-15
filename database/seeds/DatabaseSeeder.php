<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Nguyễn Chiếm Hảo',
            'email' => 'tigernguyen2205@gmail.com',
            'password' => bcrypt('admin'),
            'is_admin' => true,
            'active' => true,
        ]);
    }
}
