<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            'category_id' => Category::factory(),
            'name' => ucfirst($name),
            'slug' => fake()->unique()->slug(),
            'sku' => fake()->unique()->bothify('SKU-####'),
            'description' => fake()->optional()->paragraph(),
            'image' => null,
            'price' => fake()->randomFloat(2, 1, 500),
            'sale_price' => null,
            'quantity' => fake()->numberBetween(0, 100),
            'size_value' => null,
            'size_unit' => null,
            'featured' => fake()->boolean(),
            'is_active' => true,
        ];
    }
}
