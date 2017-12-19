<?php

namespace Frogbob\LaravelVueTSComponentGenerator\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Traits\Macroable;
use InvalidArgumentException;

class GenerateVueComponent extends GeneratorCommand {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vue:component {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new vue component';
    
    protected $type = 'Component';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name) {
        return resource_path('assets/js/components/' . $name);
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName) {
        return $this->files->exists($this->getPath($this->getNameInput()));
    }

    protected function getStub() {
        return [
            'vue.stub' => __DIR__ . '/../../resources/stubs/vue.stub',
            'ts.stub' => __DIR__ . '/../../resources/stubs/ts.stub',
            'html.stub' => __DIR__ . '/../../resources/stubs/html.stub',
            'scss.stub' => __DIR__ . '/../../resources/stubs/scss.stub',
        ];
    }
    

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName){
        return $this->files->exists($this->getPath($this->getNameInput()));
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name) {
        $replace = [
            'componentName' => $name
        ];

        return str_replace(
            array_keys($replace), array_values($replace), $this->generateClass($name)
        );
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $this->comment('Generating new vue typescript component.');
        
        $path = $this->getPath(strtolower($this->getNameInput()));
        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type.' already exist!');
            return false;
        }

        // Create component files

        foreach($this->getStub() as $name=>$stub){
            $this->current_stub = $stub;
            $this->makeDirectory($path.'/'.$name);
            $this->files->put($path.'/'.$name, $this->buildClass($this->getNameInput()));
        }

        $this->info('Component generated successfully.');
    }

}
