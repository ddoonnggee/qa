<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Models\Article::class => \App\Policies\ArticlePolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);
        $gate->before(function ($user, $ability) {
            if ($user->isAdmin()) {
                return true;
            }
        });
        if (Schema::hasTable('permissions')) {
            foreach ($this->getPermissions() as $permission) {
                $gate->define($permission->name, function ($user) use ($permission) {
                    return $user->hasRole($permission->roles);
                });
            }
        }
    }



    /**
     * Get Permissions
     * @return Collection
     */
    public function getPermissions()
    {
        return Permission::with('roles')->get();
    }
}
