<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventories')->insert([
            ['machine_id' => 1, 'product_id' => 1, 'quantity' => 16, 'created_at' => NULL, 'updated_at' => NULL],
            ['machine_id' => 1, 'product_id' => 2, 'quantity' => 8, 'created_at' => NULL, 'updated_at' => NULL],
            ['machine_id' => 1, 'product_id' => 3, 'quantity' => 6, 'created_at' => NULL, 'updated_at' => NULL],

            ['machine_id' => 2, 'product_id' => 1, 'quantity' => 6, 'created_at' => NULL, 'updated_at' => NULL],
            ['machine_id' => 2, 'product_id' => 2, 'quantity' => 0, 'created_at' => NULL, 'updated_at' => NULL],
            ['machine_id' => 2, 'product_id' => 3, 'quantity' => 6, 'created_at' => NULL, 'updated_at' => NULL],

            ['machine_id' => 3, 'product_id' => 1, 'quantity' => 1, 'created_at' => NULL, 'updated_at' => NULL],
            ['machine_id' => 3, 'product_id' => 2, 'quantity' => 0, 'created_at' => NULL, 'updated_at' => NULL],
            ['machine_id' => 3, 'product_id' => 3, 'quantity' => 2, 'created_at' => NULL, 'updated_at' => NULL],

            ['machine_id' => 4, 'product_id' => 1, 'quantity' => 6, 'created_at' => NULL, 'updated_at' => NULL],
            ['machine_id' => 4, 'product_id' => 2, 'quantity' => 4, 'created_at' => NULL, 'updated_at' => NULL],
            ['machine_id' => 4, 'product_id' => 3, 'quantity' => 6, 'created_at' => NULL, 'updated_at' => NULL],

            ['machine_id' => 5, 'product_id' => 1, 'quantity' => 5, 'created_at' => NULL, 'updated_at' => NULL],
            ['machine_id' => 5, 'product_id' => 2, 'quantity' => 5, 'created_at' => NULL, 'updated_at' => NULL],
            ['machine_id' => 5, 'product_id' => 3, 'quantity' => 0, 'created_at' => NULL, 'updated_at' => NULL],

            ['machine_id' => 6, 'product_id' => 1, 'quantity' => 16, 'created_at' => NULL, 'updated_at' => NULL],
            ['machine_id' => 6, 'product_id' => 2, 'quantity' => 0, 'created_at' => NULL, 'updated_at' => NULL],
            ['machine_id' => 6, 'product_id' => 3, 'quantity' => 0, 'created_at' => NULL, 'updated_at' => NULL],

            ['machine_id' => 7, 'product_id' => 21, 'quantity' => 4, 'created_at' => NULL, 'updated_at' => NULL],
            ['machine_id' => 7, 'product_id' => 2, 'quantity' => 4, 'created_at' => NULL, 'updated_at' => NULL],
            ['machine_id' => 7, 'product_id' => 1, 'quantity' => 4, 'created_at' => NULL, 'updated_at' => NULL],
        ]);
    }
}
