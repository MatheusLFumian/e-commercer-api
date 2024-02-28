<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sales_id' => fake()->randomNumber(9),
            'total_price' => fake()->randomFloat(),
            'products' => '[
                {
                  "product_id":' . fake()->randomNumber() . ',
                  "name": "' . fake()->name() . '",
                  "price": ' . fake()->randomFloat(2) . ',
                  "amount": ' . fake()->numberBetween(1, 50) . '
                },
                {
                  "product_id":' . fake()->randomNumber() . ',
                  "name": "' . fake()->name() . '",
                  "price": ' . fake()->randomFloat(2) . ',
                  "amount": ' . fake()->numberBetween(1, 50) . '
                },
              ]'
        ];
    }
}
