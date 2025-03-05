<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 3),
            'condition_id' => rand(1, 4),
            'name' => $this->faker->sentence(8),
            'price' => $this->faker->numberBetween(1, 10000),
            'detail' => $this->faker->realText(10),
            'shipping_address_id' => $this->faker->optional()->numberBetween(1, 3)
        ];
    }
}
