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
            'id' => $this->faker->uuid(),
            'customer_id' => $this->faker->ean8(),
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'class' => 'Bussiness',
            'email' => $this->faker->safeEmail(),
            'identity_number' => $this->faker->numerify('################'),
            'phone_number' => $this->faker->phoneNumber(),
            'company_name' => $this->faker->company(),
            'company_address' => $this->faker->streetAddress(),
            'company_npwp' => $this->faker->numerify('################'),
            'company_phone_number' => $this->faker->phoneNumber()
        ];
    }
}
