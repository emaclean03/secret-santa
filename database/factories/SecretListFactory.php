<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SecretList>
 */
class SecretListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'list_name'=> $this->faker->domainWord,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
        ];
    }
}
