<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seeddb {jumlahItem}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump the Database';

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
     * @return mixed
     */
    public function handle()
    {
        for ($i=1; $i <= $this->argument('jumlahItem') ; $i++) { 
           $this->line($i);
        }     
    }
}
