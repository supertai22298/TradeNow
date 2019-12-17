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
      $this->call(CategorySeeder::class);
      $this->call(BrandSeeder::class);
      $this->call(UsersSeeder::class);
      $this->call(ContactSeeder::class);
      $this->call(OrderStatusSeeder::class);
      // $this->call(ProductSeeder::class);

    }
  }
