<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_types')->insert([
            ['id' => 1, 'user_type' => 'customer'],
            ['id' => 2, 'user_type' => 'admin'],
        ]);
    }
}
