<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Hash;

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
        $faker = \Faker\Factory::create();

        $users = [];
        for ($i=0; $i <= $this->argument('jumlahItem') - 1; $i++) { 
           $users[$i]['email'] = $faker->email;
           $users[$i]['password'] = Hash::make(1234);
           $users[$i]['nama'] = $faker->name;
           $users[$i]['alamat'] = $faker->address;
           $users[$i]['nohp'] = '08' . $faker->numberBetween(1111111111, 9999999999);
           $users[$i]['level'] = 'p';
           $users[$i]['active'] = 'y';
           $users[$i]['verified_nohp'] = $faker->randomElement(['y', 'n']);
        }

        foreach ($users as $user) {
            foreach ($user as $key => $value) {
                $this->line($key . ' = ' . $value);
            }
            $this->line("\n");
        }

    }
}
