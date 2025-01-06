<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_can_create_a_product()
    {
        $response = $this->post('/products', [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'quantity' => 10,
            'image' => \Illuminate\Http\UploadedFile::fake()->image('product.jpg'),
            'price' => 99.99,
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
        ]);
    }

    /** @test */
    public function it_can_update_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->put("/products/{$product->id}", [
            'name' => 'Updated Product',
            'description' => 'Updated Description',
            'quantity' => 20,
            'price' => 199.99,
        ]);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product',
        ]);
    }

    /** @test */
    public function it_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $response = $this->delete("/products/{$product->id}");

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
