<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

use function PHPUnit\Framework\isEmpty;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        do {
            $random_account = Account::all()->random();
        }
        while($random_account->user->contacts->isEmpty());

        return [
            'transaction_no' => strtoupper(uniqid()),
            'amount' => round($random_account->balance/rand(5,150), -1),
            'type' => "Transfer",
            'account_no' => $random_account->account_no,
            'contact_email' => $random_account->user->contacts->random()->contact_email,
        ];
    }
}
