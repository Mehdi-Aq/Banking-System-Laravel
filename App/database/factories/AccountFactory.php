<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Monolog\Handler\StreamHandler as HandlerStreamHandler;
use Monolog\Logger;

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
    public function definition()
    {
        $user = User::all()->random();
        return [
            'account_no' => $this->faker->unique()->numberBetween(1000000, 999999999),
            'user_id' => $user->id,
            'type' => $this->faker->randomElement(array("Chequing","Savings")),
            'balance' => $this->faker->randomFloat(2, 1000, 100000),
        ];
    }
}
