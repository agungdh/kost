<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Collective\Html\FormFacade;

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
            'judul' => 'NYARIKOS.ONLINE',    
        ]);

        FormFacade::component(
            'adhSelect2', 
            'component.collective.select2', 
            [
                'title', 
                'name', 
                'hasLabel' => true, 
                'data' => [], 
                'value' => null, 
                'attributes' => [],
            ]
        );
        
        FormFacade::component(
            'adhText', 
            'component.collective.text', 
            [
                'title', 
                'name', 
                'hasLabel' => true, 
                'value' => null, 
                'attributes' => [],
            ]
        );
        
        FormFacade::component(
            'adhPassword', 
            'component.collective.password', 
            [
                'title', 
                'name', 
                'hasLabel' => true, 
                'attributes' => [],
            ]
        );
        
        FormFacade::component(
            'adhTextArea', 
            'component.collective.textarea', 
            [
                'title', 
                'name', 
                'hasLabel' => true, 
                'value' => null, 
                'attributes' => [],
            ]
        );

        FormFacade::component(
            'adhFile', 
            'component.collective.file', 
            [
                'title', 
                'name', 
                'hasLabel' => true, 
                'attributes' => [],
            ]
        );

        Blade::component('component.blade.label', 'adhLabel');
        Blade::component('component.blade.agetlocation', 'adhaGetLocation');
        Blade::component('component.blade.header', 'adhHeader');
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
