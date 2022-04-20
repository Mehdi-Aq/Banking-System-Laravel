<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::all();
        $random_user = $users->random();
        $contacts_emails = $random_user->contacts->pluck('contact_email');
        
        // Add a contact from the users table where id != $user->id AND not in contact list
        $random_email = $users->where('id', '!=', $random_user->id)->whereNotIn('email', $contacts_emails)->random()->email;

        return [
            'user_id' => $random_user,
            'contact_email' => $random_email,
        ];
    }
}
