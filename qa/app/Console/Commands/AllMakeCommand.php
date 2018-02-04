<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class AllMakeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bl5:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all resources for a entity';


    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return strtolower(str_plural($this->argument('name')));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of resource']
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['fields', null, InputOption::VALUE_OPTIONAL, 'Fields for the form and table migration', 'name:string']
        ];
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $name = $this->getNameInput();

        $fields = $this->option('fields');

        $nameFirstUpper = ucfirst($name);
        $nameFirstUpperSingular = str_singular($nameFirstUpper);

        //Create controller
        $this->call('bl5:controller', ['name' => studly_case($nameFirstUpperSingular).'Controller']);
        //Create views
        $this->call('bl5:views', ['name' => str_replace("_","",$name)]);
        //Create request
        $this->call('bl5:request', ['name' => studly_case($nameFirstUpperSingular).'Request']);
        //Create form
        $this->call('bl5:form', ['name' => studly_case($nameFirstUpperSingular).'Form']);
        //Create repositroy
        $this->call('bl5:repository', ['name' => studly_case($nameFirstUpperSingular).'Repository']);
        //Create model
        $this->call('bl5:model', ['name' => studly_case($nameFirstUpperSingular)]);
        //Migration table
        $this->call('make:migration:schema', ['name' => 'create_'.$name.'_table', '--schema' => $fields, '--model' => 0]);
    }


}
