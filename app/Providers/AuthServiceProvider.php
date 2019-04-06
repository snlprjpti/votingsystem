<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
            if($user->type == 'admin')
            {
                return true;
            }
            return false;
        });
        Gate::define('isOrganizer', function ($user) {
            if($user->type == 'org')
            {
                return true;
            }
            return false;
        });
        Gate::define('isVoter', function ($user) {
            if($user->type == 'voter')
            {
                return true;
            }
            return false;
        });
    }
}
