<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "customer_id"=>Customer::factory(),
            "invoice_count" => $this->faker->randomElement([6, 9, 12]),
            "amount" => $this->faker->randomElement([10000000, 12000000, 15000000, 20000000]),
        ];
    }
}
