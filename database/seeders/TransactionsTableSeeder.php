<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert([
            ['id' => 1, 'quantity' => 2, 'total_price' => 9.50, 'user_id' => 1, 'machine_id' => 7, 'product_id' => 2, 'created_at' => '2024-12-28 06:46:19', 'updated_at' => '2024-12-28 07:12:31', 'dispensed' => 1],
            ['id' => 2, 'quantity' => 2, 'total_price' => 9.50, 'user_id' => 1, 'machine_id' => 1, 'product_id' => 8, 'created_at' => '2024-12-28 07:13:22', 'updated_at' => '2024-12-28 07:14:48', 'dispensed' => 1],
            ['id' => 3, 'quantity' => 2, 'total_price' => 16.00, 'user_id' => 4, 'machine_id' => 7, 'product_id' => 4, 'created_at' => '2024-12-28 07:13:52', 'updated_at' => '2024-12-28 07:14:31', 'dispensed' => 1],
            ['id' => 4, 'quantity' => 1, 'total_price' => 4.75, 'user_id' => 2, 'machine_id' => 3, 'product_id' => 7, 'created_at' => '2024-12-29 07:24:09', 'updated_at' => '2024-12-29 07:36:41', 'dispensed' => 1],
            ['id' => 5, 'quantity' => 1, 'total_price' => 4.75, 'user_id' => 1, 'machine_id' => 5, 'product_id' => 21, 'created_at' => '2024-12-29 07:36:58', 'updated_at' => '2024-12-29 07:38:55', 'dispensed' => 1],
            ['id' => 6, 'quantity' => 1, 'total_price' => 8.00, 'user_id' => 1, 'machine_id' => 7, 'product_id' => 4, 'created_at' => '2024-12-29 07:38:15', 'updated_at' => '2024-12-29 07:38:22', 'dispensed' => 0],
            ['id' => 7, 'quantity' => 8, 'total_price' => 4.75, 'user_id' => 1, 'machine_id' => 7, 'product_id' => 2, 'created_at' => '2024-12-30 07:39:29', 'updated_at' => '2024-12-30 07:40:11', 'dispensed' => 1],
            ['id' => 8, 'quantity' => 3, 'total_price' => 14.25, 'user_id' => 1, 'machine_id' => 7, 'product_id' => 15, 'created_at' => '2024-12-30 07:40:39', 'updated_at' => '2024-12-30 07:40:44', 'dispensed' => 0],
            ['id' => 9, 'quantity' => 1, 'total_price' => 4.75, 'user_id' => 2, 'machine_id' => 6, 'product_id' => 2, 'created_at' => '2024-12-30 07:41:31', 'updated_at' => '2024-12-30 07:41:45', 'dispensed' => 1],
            ['id' => 10, 'quantity' => 6, 'total_price' => 48.00, 'user_id' => 1, 'machine_id' => 6, 'product_id' => 4, 'created_at' => '2024-12-30 07:41:57', 'updated_at' => '2024-12-30 07:42:03', 'dispensed' => 1],
            ['id' => 11, 'quantity' => 1, 'total_price' => 4.75, 'user_id' => 2, 'machine_id' => 7, 'product_id' => 2, 'created_at' => '2024-12-30 07:44:49', 'updated_at' => '2024-12-30 07:49:29', 'dispensed' => 1],
            ['id' => 12, 'quantity' => 7, 'total_price' => 8.00, 'user_id' => 1, 'machine_id' => 5, 'product_id' => 4, 'created_at' => '2024-12-31 07:44:50', 'updated_at' => '2024-12-31 07:44:56', 'dispensed' => 0],
            ['id' => 14, 'quantity' => 1, 'total_price' => 30.00, 'user_id' => 2, 'machine_id' => 1, 'product_id' => 1, 'created_at' => '2024-12-30 23:15:22', 'updated_at' => '2024-12-31 09:32:38', 'dispensed' => 1],
            ['id' => 17, 'quantity' => 2, 'total_price' => 9.50, 'user_id' => 2, 'machine_id' => 7, 'product_id' => 12, 'created_at' => '2024-12-31 07:53:01', 'updated_at' => '2024-12-31 08:56:42', 'dispensed' => 1],
            ['id' => 18, 'quantity' => 1, 'total_price' => 4.75, 'user_id' => 1, 'machine_id' => 3, 'product_id' => 2, 'created_at' => '2025-01-01 08:34:48', 'updated_at' => '2025-01-07 17:50:14', 'dispensed' => 1],
            ['id' => 19, 'quantity' => 22, 'total_price' => 12.00, 'user_id' => 2, 'machine_id' => 2, 'product_id' => 1, 'created_at' => '2025-01-01 23:18:26', 'updated_at' => '2025-01-01 23:18:26', 'dispensed' => 0],
            ['id' => 21, 'quantity' => 5, 'total_price' => 25.00, 'user_id' => 1, 'machine_id' => 1, 'product_id' => 17, 'created_at' => '2025-01-02 11:06:25', 'updated_at' => '2025-01-02 11:06:25', 'dispensed' => 0],
            ['id' => 22, 'quantity' => 12, 'total_price' => 17.00, 'user_id' => 1, 'machine_id' => 2, 'product_id' => 8, 'created_at' => '2025-01-03 11:06:25', 'updated_at' => '2025-01-03 11:06:25', 'dispensed' => 0],
            ['id' => 23, 'quantity' => 1, 'total_price' => 4.75, 'user_id' => 1, 'machine_id' => 6, 'product_id' => 2, 'created_at' => '2025-01-05 19:20:39', 'updated_at' => '2025-01-05 19:20:39', 'dispensed' => 0],
            ['id' => 24, 'quantity' => 4, 'total_price' => 34.00, 'user_id' => 12, 'machine_id' => 5, 'product_id' => 8, 'created_at' => '2025-01-06 10:51:10', 'updated_at' => '2025-01-06 10:51:10', 'dispensed' => 0],
            ['id' => 25, 'quantity' => 2, 'total_price' => 28.00, 'user_id' => 12, 'machine_id' => 6, 'product_id' => 3, 'created_at' => '2025-01-06 11:06:29', 'updated_at' => '2025-01-06 12:31:00', 'dispensed' => 1],
            ['id' => 27, 'quantity' => 2, 'total_price' => 24.00, 'user_id' => 12, 'machine_id' => 6, 'product_id' => 9, 'created_at' => '2025-01-06 12:37:26', 'updated_at' => '2025-01-06 12:38:39', 'dispensed' => 1],
            ['id' => 28, 'quantity' => 2, 'total_price' => 24.00, 'user_id' => 12, 'machine_id' => 6, 'product_id' => 9, 'created_at' => '2025-01-06 12:37:52', 'updated_at' => '2025-01-06 12:38:38', 'dispensed' => 1],
            ['id' => 30, 'quantity' => 1, 'total_price' => 4.75, 'user_id' => 12, 'machine_id' => 6, 'product_id' => 2, 'created_at' => '2025-01-06 13:02:50', 'updated_at' => '2025-01-06 13:02:50', 'dispensed' => 0],
            ['id' => 31, 'quantity' => 1, 'total_price' => 15.00, 'user_id' => 12, 'machine_id' => 6, 'product_id' => 10, 'created_at' => '2025-01-06 13:26:10', 'updated_at' => '2025-01-06 13:32:21', 'dispensed' => 1],
            ['id' => 32, 'quantity' => 1, 'total_price' => 6.75, 'user_id' => 12, 'machine_id' => 6, 'product_id' => 12, 'created_at' => '2025-01-06 13:32:09', 'updated_at' => '2025-01-06 13:32:20', 'dispensed' => 1],
            ['id' => 33, 'quantity' => 1, 'total_price' => 7.00, 'user_id' => 13, 'machine_id' => 4, 'product_id' => 1, 'created_at' => '2025-01-07 17:12:14', 'updated_at' => '2025-01-07 17:56:14', 'dispensed' => 1],
            ['id' => 34, 'quantity' => 1, 'total_price' => 4.75, 'user_id' => 13, 'machine_id' => 6, 'product_id' => 2, 'created_at' => '2025-01-07 17:52:45', 'updated_at' => '2025-01-07 18:19:12', 'dispensed' => 1],
            ['id' => 35, 'quantity' => 1, 'total_price' => 4.75, 'user_id' => 13, 'machine_id' => 6, 'product_id' => 2, 'created_at' => '2025-01-07 18:12:04', 'updated_at' => '2025-01-07 18:12:14', 'dispensed' => 1],
            ['id' => 36, 'quantity' => 1, 'total_price' => 8.00, 'user_id' => 12, 'machine_id' => 6, 'product_id' => 4, 'created_at' => '2025-01-08 05:38:31', 'updated_at' => '2025-01-08 05:38:31', 'dispensed' => 0],
        ]);
    }
}
