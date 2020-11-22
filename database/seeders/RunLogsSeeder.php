<?php

namespace Database\Seeders;

use App\Models\Run;
use Illuminate\Database\Seeder;

class RunLogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Run::factory()->count(10)->create();
    }
}
