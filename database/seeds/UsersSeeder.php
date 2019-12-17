<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $users = [
      ['name' => 'Admin', 'email' => 'admin@admin.com', 'password'=>Hash::make('password'), 'is_admin' => 1],
      ['name' => 'Nguyễn Văn Tài', 'email' => 'supertai22298@gmail.com', 'password'=>Hash::make('tai123'), 'is_admin' => 1],
    ];
    foreach ($users as $key => $user) {
      DB::table('users')->insert($user);
    }
  }
}
