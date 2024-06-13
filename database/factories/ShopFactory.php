<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $weeks = ["月", "火", "水", "木", "金", "土", "日"];

        return [
            'name' => fake()->kanaName(),
            'description' => fake()->realText(),
            'openingtime' => fake()->time('H:i'),
            'closingtime' => fake()->time('H:i'),
            'price' => fake()->numberBetween(1000, 100000),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'closingday' => "毎週". $weeks[rand(0,6)]. "曜日",
            'image' => "test.jpg",
            'category_id' => fake()->numberBetween(1, 9),

        ];
    }
}
