<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share([
            'judul' => 'Aplikasi Gak Tau',    
            'bank' => [
                'namaBank' => 'MBOH',
                'kodeBank' => '020',
                'noRek' => '12345678',
                'atasNama' => 'Agung DH',
            ],
        ]);

        \Collective\Html\FormFacade::component('adhSelect2', 'component.select2', ['title', 'name', 'data', 'value', 'attributes']);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
