<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 2,
            'account_number' => $this->faker->unique()->numerify('##########'), // 10-digit number
            'account_type' => $this->faker->randomElement(['savings', 'current', 'fixed_deposit']),
            'balance' => $this->faker->randomFloat(2, 100, 100000), // min 100, max 100k
            'pin_hash' => bcrypt('1234'), // default pin
            'status' => $this->faker->randomElement(['active', 'inactive', 'blocked']),
            'daily_limit' => $this->faker->randomFloat(2, 1000, 10000),
        ];
    }
}
