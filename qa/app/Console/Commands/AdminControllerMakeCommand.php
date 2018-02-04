<?php

namespace App\Console\Commands;

use App\Console\Commands\CustomGeneratorCommand;

class AdminControllerMakeCommand extends CustomGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bl5:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin controller class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Text more info finish
     *
     * @var string
     */
    protected $more_info = "
Add routes in app/Http/routes.php into group admin

//{{Models}}
Route::resource('{{models}}', '{{Models}}Controller');


Add menu in array menus in config/menus.php :

'{{models}}' => [
    'permission' => '{{models}}_view',
    'icon' => 'fa-file-o',
    'edit' => true,
    'name' => 'messages.{{models}}'
],


Add custom messages in resources/lang/zh/messages.php

'{{models}}' => '{{models}}',

Migrate {{models}}

php artisan migrate
";

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/controller.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers\Admin';
    }
}
