<?php

namespace Frogbob\LaravelVueTsComponentGenerator;

use Illuminate\Support\ServiceProvider;

class LaravelVueTsComponentGeneratorProvider extends ServiceProvider {
    
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