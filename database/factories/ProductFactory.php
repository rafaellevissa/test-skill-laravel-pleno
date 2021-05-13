<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $client = new Client();

        $clients_id = $client->all('id')->flatten()->all();

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'sku' => $this->faker->ean13(),
            'client_id' => $this->faker->randomElement($clients_id),
            'stock_amount' => $this->faker->numberBetween(0, 100)
        ];
    }
}
