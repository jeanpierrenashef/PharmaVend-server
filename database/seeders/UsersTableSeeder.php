<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['id' => 1, 'username' => 'jeanpierre', 'password' => '$2y$12$HSRJVc/faNIqSbtOxSSbK.m4bntczvHZ.V9b9WOiwJhvveatsxaw.', 'email' => 'jeanpierrenashef@gmail.com', 'created_at' => '2024-12-15 19:10:01', 'updated_at' => '2024-12-25 11:13:01', 'user_type_id' => 2],
            ['id' => 2, 'username' => 'jason', 'password' => '$2y$12$N6HRq3OKVasUSN44nkI.o.wkh0DkpH9V43KBUqBhl5xkPjp4x8Fxa', 'email' => 'jason.daoud@gmail.com', 'created_at' => '2024-12-16 17:25:18', 'updated_at' => '2024-12-25 11:13:02', 'user_type_id' => 1],
            ['id' => 3, 'username' => 'taha', 'password' => '$2y$12$TnuRrWfpMNk98ZcGG3Jtu.9sxmI.atpmaA2c9fKjkzSA1B0jnp6jS', 'email' => 'taha@gmail.com', 'created_at' => '2024-12-20 10:17:02', 'updated_at' => '2024-12-31 10:17:02', 'user_type_id' => 1],
            ['id' => 12, 'username' => 'nahwa', 'password' => '$2y$12$5A3Bhv5lpR9tRvTXDDXlCOAqVW4c/gQ7s24NSEMvuFgSUDQ1isWze', 'email' => 'nahwa@gmail.com', 'created_at' => '2025-01-05 21:02:41', 'updated_at' => '2025-01-05 21:02:41', 'user_type_id' => 2],
            ['id' => 13, 'username' => 'justin', 'password' => '$2y$12$cNB4rrrpyunymC8ptM5CvOw.foL2xTxdR1HmAgbrO6hMS9jgLg4.a', 'email' => 'justin@gmail.com', 'created_at' => '2025-01-07 17:03:10', 'updated_at' => '2025-01-07 17:03:10', 'user_type_id' => 1],
            ['id' => 14, 'username' => 'Netflix Middle East', 'password' => NULL, 'email' => 'jp.nashef@gmail.com', 'created_at' => '2025-01-12 22:36:26', 'updated_at' => '2025-01-12 22:36:26', 'user_type_id' => 1],
            ['id' => 15, 'username' => 'ahmad bassil', 'password' => NULL, 'email' => 'surfrieses@gmail.com', 'created_at' => '2025-01-12 23:04:41', 'updated_at' => '2025-01-12 23:04:41', 'user_type_id' => 1],
            ['id' => 17, 'username' => 'test', 'password' => '$2y$12$I00aWVQdy06fBjbKN44Jbung58wELGI1etncFHQDhKiDOujdVEHT.', 'email' => 'test@gmail.com', 'created_at' => '2025-01-19 17:00:10', 'updated_at' => '2025-01-19 17:00:10', 'user_type_id' => 1]
        ]);
    }
}
