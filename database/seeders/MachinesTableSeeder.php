<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MachinesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('machines')->insert([
            ['id' => 1, 'location' => 'LAU Byblos campus', 'latitude' => 34.115568, 'longitude' => 35.674343, 'status' => 'active', 'created_at' => '2024-12-10 19:00:00', 'updated_at' => '2024-12-10 19:00:00'],
            ['id' => 2, 'location' => 'Sidon, Nejmeh Square', 'latitude' => 33.564852, 'longitude' => 35.375365, 'status' => 'active', 'created_at' => '2024-12-30 23:00:00', 'updated_at' => '2024-12-30 23:00:00'],
            ['id' => 3, 'location' => 'Dimit, Rawad street', 'latitude' => 33.690236, 'longitude' => 35.505354, 'status' => 'inactive', 'created_at' => '2024-12-30 23:00:00', 'updated_at' => '2025-01-19 23:53:56'],
            ['id' => 4, 'location' => 'Naameh, Cafe Naam', 'latitude' => 33.744713, 'longitude' => 35.461489, 'status' => 'active', 'created_at' => '2024-12-30 23:00:00', 'updated_at' => '2025-01-14 21:20:51'],
            ['id' => 5, 'location' => 'Hamra street, main BLDG', 'latitude' => 33.896198, 'longitude' => 35.477865, 'status' => 'active', 'created_at' => '2024-12-10 19:28:13', 'updated_at' => '2025-01-15 09:30:30'],
            ['id' => 6, 'location' => 'Ghobeiri, Khiyami Pharma', 'latitude' => 33.859295, 'longitude' => 35.502079, 'status' => 'active', 'created_at' => '2024-12-30 23:00:00', 'updated_at' => '2025-01-02 20:19:27'],
            ['id' => 7, 'location' => 'Bar Elias, St. theas', 'latitude' => 33.772607, 'longitude' => 35.898624, 'status' => 'inactive', 'created_at' => '2024-12-25 09:58:29', 'updated_at' => '2025-01-19 00:15:37'],
            ['id' => 37, 'location' => 'Darayya District, Rif Dimashq Governorate, F75F+XRX', 'latitude' => 33.459500, 'longitude' => 36.274300, 'status' => 'active', 'created_at' => '2025-01-20 01:24:51', 'updated_at' => '2025-01-20 01:24:55']
        ]);
    }
}
