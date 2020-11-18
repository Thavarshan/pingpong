<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DateOnServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'show:time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show current PHP configured timezone date and time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line(now()->format('F j, Y - h:i a'));

        return 0;
    }
}
