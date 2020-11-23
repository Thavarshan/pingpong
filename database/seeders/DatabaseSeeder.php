<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StudentsSeeder::class,
            DefaultUserSeeder::class,
        ]);

        // if (app()->isLocal()) {
        //     $this->call([RunLogsSeeder::class]);
        // }
    }
}
