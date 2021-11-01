<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class IncrementCumulconges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'solde:increment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Incrémenter le solde par 1.5 à la fin de chaque mois';

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
        DB::table('users')->increment('solde', 1.5);
    }
}
