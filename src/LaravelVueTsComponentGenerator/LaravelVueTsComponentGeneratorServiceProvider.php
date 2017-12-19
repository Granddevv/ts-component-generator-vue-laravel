<?php

namespace Frogbob\LaravelVueTSComponentGenerator;

use Illuminate\Support\ServiceProvider;

class LaravelVueTSComponentgeneratorProvider extends ServiceProvider {
    
    protected $commands = [
        Commands\GenerateVueComponent::class
    ];
    
    public function boot(){

    }

    /**
     * Register the service provider.
     */
    public function register(){
        $this->commands($this->commands);
    }
        
}