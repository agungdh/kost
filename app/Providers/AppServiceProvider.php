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

        \Collective\Html\FormFacade::component(
            'adhSelect2', 
            'component.select2', 
            [
                'title', 
                'name', 
                'hasLabel' => true, 
                'data' => [], 
                'value' => null, 
                'attributes' => [],
            ]
        );
        
        \Collective\Html\FormFacade::component(
            'adhText', 
            'component.text', 
            [
                'title', 
                'name', 
                'hasLabel' => true, 
                'value' => null, 
                'attributes' => [],
            ]
        );
        
        \Collective\Html\FormFacade::component(
            'adhPassword', 
            'component.password', 
            [
                'title', 
                'name', 
                'hasLabel' => true, 
                'attributes' => [],
            ]
        );
        
        \Collective\Html\FormFacade::component(
            'adhTextArea', 
            'component.textarea', 
            [
                'title', 
                'name', 
                'hasLabel' => true, 
                'value' => null, 
                'attributes' => [],
            ]
        );

        \Collective\Html\FormFacade::component(
            'adhFile', 
            'component.file', 
            [
                'title', 
                'name', 
                'hasLabel' => true, 
                'attributes' => [],
            ]
        );
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
