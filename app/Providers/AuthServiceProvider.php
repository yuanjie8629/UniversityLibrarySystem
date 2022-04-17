<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define("isAdmin", function ($user) {
            return $user->role == "ADMIN";
        });

        Gate::define("isLecturer", function ($user) {
            return $user->role == "LECTURER";
        });

        Gate::define("isStudent", function ($user) {
            return $user->role == "STUDENT";
        });

        Gate::define("isNotAdmin", function ($user) {
            return $user->role != "ADMIN";
        });
    }
}
