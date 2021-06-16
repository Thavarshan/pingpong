<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(config('defaults.users.credentials'));

        $user->address()->create([
            'line1' => '4431 Birch Street',
            'city' => 'Greenwood',
            'state' => 'Indiana',
            'country' => 'United States',
            'postal_code' => '46142',
        ]);
    }
}
