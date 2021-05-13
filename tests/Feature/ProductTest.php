<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Store a new product
     *
     * @return void
     */
    public function test_store_product()
    {
        $user = Client::factory()->create();
        
        $this->actingAs($user);

        $product = [
            'name' => 'my_product',
            'description' => 'new product',
            'price' => 20.50,
            'sku' => '1234',
            'stock_amount' => 10
        ];

        $response = $this->post('/api/product', $product);

        $response->assertStatus(201);
    }

    /**
     * Listing products stored.
     *
     * @return void
     */
    public function test_products()
    {
        $user = Client::factory()->create();
        
        $this->actingAs($user);

        $response = $this->get('/api/product');

        $response->assertStatus(200);
    }

    /**
     * Get a product
     *
     * @return void
     */
    public function test_get_product_by_id()
    {
        $user = Client::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user);
        
        $response = $this->get("/api/product/${product['id']}");

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $product['id'],
                'created_at' => $product['created_at']
            ]);
    }

    /**
     * Trying to get product by id with an invalid id
     *
     * @return void
     */
    public function test_get_product_with_invalid_id()
    {
        $user = Client::factory()->create();
        $product = Product::factory()->create();

        $invalidProductId = $product['id'] + 1;

        $this->actingAs($user);
        
        $response = $this->get("/api/product/${invalidProductId}");

        $response->assertStatus(404);
    }

    /**
     * Delete product by its id
     *
     * @return void
     */
    public function test_delete_product_by_id()
    {
        $user = Client::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user);
        
        $response = $this->delete("/api/product/{$product['id']}");

        $response->assertStatus(201);
    }

    /**
     * Update product by its id
     *
     * @return void
     */
    public function test_update_by_id()
    {
        $user = Client::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user);

        $newProductData = [
            'name' => 'my_product',
            'description' => 'new product',
            'price' => 20.50,
            'sku' => '1234',
            'stock_amount' => 10
        ];
        
        $response = $this->put("/api/product/{$product['id']}", $newProductData);

        $response->assertStatus(201);
    }

    /**
     * Update product by its id
     *
     * @return void
     */
    public function test_update_with_invalid_id()
    {
        $user = Client::factory()->create();
        $product = Product::factory()->create();

        $invalidProductId = $product['id'] + 1;

        $this->actingAs($user);

        $newProductData = [
            'name' => 'my_product',
            'description' => 'new product',
            'price' => 20.50,
            'sku' => '1234',
            'stock_amount' => 10
        ];
        
        $response = $this->put("/api/product/{$invalidProductId}", $newProductData);

        $response->assertStatus(404);
    }
}
