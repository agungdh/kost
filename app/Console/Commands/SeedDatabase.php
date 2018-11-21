<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Hash;

use App\User;
use App\Kos;
use App\Foto;

use agungdh\Pustaka;

use DB;
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
        $faker = new \Faker\Generator();
        $faker->addProvider(new \Faker\Provider\Base($faker));
        $faker->addProvider(new \Faker\Provider\en_US\Text($faker));
        $faker->addProvider(new \Faker\Provider\en_US\Person($faker));
        $faker->addProvider(new \Faker\Provider\en_US\Address($faker));
        $faker->addProvider(new \Faker\Provider\Internet($faker));
        // User
        // $users = [];
        // for ($i=0; $i <= $this->argument('jumlahItem') - 1; $i++) { 
        //    $users[$i]['email'] = $faker->email;
        //    $users[$i]['password'] = Hash::make(1234);
        //    $users[$i]['nama'] = $faker->name;
        //    $users[$i]['alamat'] = $faker->address;
        //    $users[$i]['nohp'] = '08' . $faker->numberBetween(1111111111, 9999999999);
        //    $users[$i]['level'] = 'p';
        //    $users[$i]['active'] = 'y';
        //    $users[$i]['verified_nohp'] = $faker->randomElement(['y', 'n']);
        // }

        // User::insert($users);
        // End User

        // Kos
        $kosses = [];
        
        $userId = [];
        foreach (User::where('level', 'p')->get() as $value) {
            $userId[] = $value->id;
        }

        $desaId = [];
        foreach (DB::table('v_daerah')->where('prop_id', '18')->get() as $value) {
            $desaId[] = $value->desa_id;
        }

        for ($i=0; $i <= $this->argument('jumlahItem') - 1; $i++) {
            $kosses[$i]['id_user'] = $faker->randomElement($userId);
            $kosses[$i]['nama'] = $faker->name;
            $kosses[$i]['alamat'] = $faker->address;
            $kosses[$i]['id_desa'] = $faker->randomElement($desaId);
            $kosses[$i]['tipe'] = $faker->randomElement(['l', 'p', 'lp']);
            $kosses[$i]['bulanan'] = Pustaka::decimalRand(300000, 1000000, 100000);
            $kosses[$i]['tahunan'] = Pustaka::decimalRand(1500000, 10000000, 250000);
            $kosses[$i]['deskripsi'] = $faker->realText(500);
            $kosses[$i]['kamartersedia'] = $faker->randomNumber(2);
            $kosses[$i]['latitude'] = $faker->latitude();
            $kosses[$i]['longitude'] = $faker->longitude();
            $kosses[$i]['verified_alamat'] = $faker->randomElement(['y', 'n']);
        }
        Kos::insert($kosses);
        // End Kos

        // Fotos
        $fotos = [];

        $kosses = Kos::all();
        $i = 0;
        foreach ($kosses as $kos) {
            $fotos[$i++] = ['id_kos' => $kos->id, 'deskripsi' => $faker->realText(191)];
            $fotos[$i++] = ['id_kos' => $kos->id, 'deskripsi' => $faker->realText(191)];
            $fotos[$i++] = ['id_kos' => $kos->id, 'deskripsi' => $faker->realText(191)];
            $fotos[$i++] = ['id_kos' => $kos->id, 'deskripsi' => $faker->realText(191)];
            $fotos[$i++] = ['id_kos' => $kos->id, 'deskripsi' => $faker->realText(191)];
        }

        Foto::insert($fotos);
        // End Fotos

    }
}
