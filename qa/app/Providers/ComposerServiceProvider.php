<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('datatable', 'App\Composers\RouteComposer');
        view()->composer('layout.master', 'App\Composers\RouteComposer');
        view()->composer('layout.partials.content', 'App\Composers\RouteComposer');
        view()->composer('layout.partials.table', 'App\Composers\RouteComposer');
        view()->composer('layout.partials.datatable', 'App\Composers\RouteComposer');
        view()->composer('layout.partials.form', 'App\Composers\RouteComposer');
        view()->composer('layout.partials.ajax_form', 'App\Composers\RouteComposer');
        view()->composer('layout.partials.show', 'App\Composers\RouteComposer');
        view()->composer('rbac.permission_groups', 'App\Composers\RouteComposer');

        view()->composer('layout.partials.nav.profile', 'App\Composers\AuthComposer');
        view()->composer('layout.partials.sidebar.user', 'App\Composers\AuthComposer');

        view()->composer('layout.partials.sidebar.menu', 'App\Composers\MenusComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
