<?php

namespace App\Providers;

use App\Actions\API\UpdateApiToken;
use App\Actions\API\CreateNewApiToken;
use Illuminate\Support\ServiceProvider;
use Emberfuse\Blaze\API\Permission;
use Emberfuse\Scorch\Providers\Traits\HasActions;
use Emberfuse\Blaze\Contracts\Actions\UpdatesApiTokens;
use Emberfuse\Blaze\Contracts\Actions\CreatesNewApiTokens;

class BlazeServiceProvider extends ServiceProvider
{
    use HasActions;

    /**
     * The scorch action classes.
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
