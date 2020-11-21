<?php

namespace App\Console\Commands;

use App\Models\Token;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GenerateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:generate {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate API token';

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
        $tokenString = Str::random(21);

        Token::create([
            'name' => $this->option('name'),
            'token' => Hash::make($tokenString),
        ]);

        $this->line($tokenString);

        return 0;
    }
}
