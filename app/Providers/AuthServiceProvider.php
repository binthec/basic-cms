<?php

namespace App\Providers;

use App\Policies\UserPolicy;
use App\User;
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
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //開発者のみ許可
        Gate::define('system-only', function ($user) {
            return $user->role === User::SYSTEM_ADMIN;
        });

        //オーナー以上（＝開発者とオーナー）のみ許可
        Gate::define('owner-higher', function ($user) {
            return $user->role <= User::OWNER && $user->role >= User::SYSTEM_ADMIN;
        });
    }
}
