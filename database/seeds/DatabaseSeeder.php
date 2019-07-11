<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

      // Populate Test Data ( 50 users )
      for( $i = 0; $i < 50; $i++ )
      {
        $faker = Faker::create();
        $user = [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        ];

        User::create($user);
      }
    }
}
