<?php

namespace App\Providers;

use Laravel\Passport\Passport;
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

        Passport::routes();

        Passport::tokensExpireIn(now()->addDays(15));

        Passport::refreshTokensExpireIn(now()->addDays(30));

        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        Passport::tokensCan([
            'create-post' => 'Create new post',
            'update-post' => 'Update a post',
            'delete-post' => 'Delete a post',
            'create-tag' => 'Create new tag',
            'update-tag' => 'Update a tag',
            'delete-tag' => 'Delete a tag'
        ]);

        Passport::setDefaultScope([
            'create-post',
            'create-tag',
        ]);
    }
}
