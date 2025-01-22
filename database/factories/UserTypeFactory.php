<?php

// database/factories/UserTypeFactory.php
namespace Database\Factories;

use App\Models\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTypeFactory extends Factory
{
    protected $model = UserType::class;

    public function definition()
    {
        return [
            // Assuming you have types like 'admin', 'customer', etc.
            'user_type' => $this->faker->randomElement(['admin', 'customer']),
        ];
    }
}

