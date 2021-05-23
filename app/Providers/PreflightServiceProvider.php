<?php

namespace App\Providers;

use App\Actions\API\UpdateApiToken;
use App\Actions\API\CreateNewApiToken;
use Illuminate\Support\ServiceProvider;
use Cratespace\Preflight\API\Permission;
use Cratespace\Sentinel\Providers\Traits\HasActions;
use Cratespace\Preflight\Contracts\API\UpdatesApiTokens;
use Cratespace\Preflight\Contracts\API\CreatesNewApiTokens;

class PreflightServiceProvider extends ServiceProvider
{
    use HasActions;

    /**
     * The sentinel action classes.
     *
     * @var array
     */
    protected $actions = [
        CreatesNewApiTokens::class => CreateNewApiToken::class,
        UpdatesApiTokens::class => UpdateApiToken::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerActions();

        $this->configurePermissions();
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Permission::defaultApiTokenPermissions(['read']);

        Permission::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
