<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        create(Contact::class, [], null, 30)
            ->each(function (Contact $contact) {
                $contact->address()->create([
                    'line1' => '4431 Birch Street',
                    'city' => 'Greenwood',
                    'state' => 'Indiana',
                    'country' => 'United States',
                    'postal_code' => '46142',
                ]);
            });
    }
}
