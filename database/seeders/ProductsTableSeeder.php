<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            ['id' => 1, 'name' => 'Panadol', 'description' => 'Paracetamol tablets are widely used for the relief of mild to moderate pain and fever. They are particularly effective for headaches, muscle aches, and cold or flu symptoms.', 'category' => 'Analgesics', 'price' => 6.00, 'image_url' => 'https://www.panadol.com/content/dam/cf-consumer-healthcare/panadol-reborn/en_IE/redesign/product-packshots/Panadol-Base-Compack-12s-(3D).png', 'created_at' => NULL, 'updated_at' => '2025-01-13 14:05:41'],
            ['id' => 2, 'name' => 'Ibuprofen', 'description' => 'Ibuprofen is a non-steroidal anti-inflammatory drug (NSAID) used to reduce inflammation and alleviate pain, including headaches, menstrual cramps, and muscle aches. It is also effective in lowering fever.', 'category' => 'Analgesics', 'price' => 4.75, 'image_url' => 'https://m.media-amazon.com/images/I/715cDkxlRPL._AC_SL1500_.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'name' => 'Asthma Inhaler', 'description' => 'This quick-relief inhaler provides fast-acting medication to open up airways during asthma attacks or other respiratory conditions. It helps improve breathing and prevent severe asthma symptoms.', 'category' => 'Inhalant', 'price' => 14.00, 'image_url' => 'https://www.ashcroftpharmacy.co.uk/uploads/images/products/large/ashcroft-pharmacy-ventolin-inhaler-1653862554ventolin-inhaler-100micrograms-200-actuations-min.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 4, 'name' => 'Vitamin C Tablets', 'description' => 'Vitamin C tablets are essential for strengthening the immune system, promoting wound healing, and maintaining healthy skin and connective tissue. They also act as powerful antioxidants.', 'category' => 'Complementary medicines', 'price' => 8.00, 'image_url' => 'https://images-cdn.ubuy.co.in/6519804c99942957d93004fe-spring-valley-vitamin-c-tablets-with.jpg', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'name' => 'Caffeine Pills', 'description' => 'Caffeine pills provide a quick energy boost and help improve focus, alertness, and concentration. They are commonly used to combat fatigue and enhance physical performance.', 'category' => 'Stimulant', 'price' => 6.50, 'image_url' => 'https://thesupplementsfactory.com/cdn/shop/files/mysupplement-Caffeine-100caps-1000x1000.png?v=1700478249', 'created_at' => NULL, 'updated_at' => NULL]
        ]);
    }
}
