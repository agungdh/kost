<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class EmptyTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emptytable {tableName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Empty DB Table with Delete syntax';

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
        $tableName = $this->argument('tableName');
        if (\Illuminate\Support\Facades\Schema::hasTable($tableName)) {
            $this->line("Empty table: {$tableName}");

            $sql = "DELETE FROM {$tableName}";
            $this->info("SQL: {$sql}");
            DB::table($tableName)->delete();
        } else {
            $this->error("Table {$tableName} Not Found!");
        }
    }
}
