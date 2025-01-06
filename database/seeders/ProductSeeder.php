<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Insert 10 products
        foreach (range(1, 10) as $index) {
            Product::create([
                'name' => $faker->word(),
                'description' => $faker->sentence(10),
                'quantity' => $faker->numberBetween(1, 100),
                'image' => 'product_images/default.jpg', 
                'price' => $faker->randomFloat(2, 10, 1000),
            ]);
        }
    }
}
