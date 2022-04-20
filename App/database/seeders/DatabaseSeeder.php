<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)
        ->hasAccounts(2)
        ->create();

        /*
        ->hasAccounts(2, [
            'published' => false,
        ])
        ->create();

        $user = User::factory()->hasPosts(3, [
                'published' => false,
            ])
            ->create();
            */
        //User::factory(10)->create();
        //Account::factory(1)->create();
        Contact::factory(50)->create();
        Transaction::factory(100)->create();
    }
}
