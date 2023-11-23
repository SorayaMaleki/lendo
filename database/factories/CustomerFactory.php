<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name"=>$this->faker->firstName,
            "mobile"=>"09191213869",
            "status"=>"normal",
            "complete_info"=>true,
            "bank_account_number"=>"621717179875847",

        ];
    }
}
