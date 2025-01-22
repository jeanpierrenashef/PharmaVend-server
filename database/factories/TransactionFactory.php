<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;
    
    public function definition()
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 10),
            'total_price' => $this->faker->randomFloat(2, 10, 500),
            'user_id' => $this->faker->numberBetween(1, 50), 
            'machine_id' => $this->faker->numberBetween(1, 10),
            'product_id' => $this->faker->numberBetween(1, 50),
            'dispensed' => $this->faker->boolean,
        ];
    }
}
