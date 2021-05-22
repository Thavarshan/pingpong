<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacts = json_decode(file_get_contents(
            resource_path('data/contacts.json')
        ), true);

        $userId = User::whereName('Administrator')->first()->id;

        foreach ($contacts as $contact) {
            Contact::create([
                'name' => $contact['name'],
                'email' => $contact['email'],
                'birthday' => $contact['birthday'],
                'user_id' => $userId,
            ]);
        }
    }
}
