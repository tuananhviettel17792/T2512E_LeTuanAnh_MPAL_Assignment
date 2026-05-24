<?php

namespace Database\Factories;

use App\Models\BankAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BankAccount>
 */
class BankAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): void
    {
        return [
            'account_number' => fake()->unique()->numerify('##########'),
            'full_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'balance' => fake()->randomFloat(2, 0, 500000000),
            'status' => fake()->randomElement(['active', 'inactive', 'banned']),
        ];
    }
}
