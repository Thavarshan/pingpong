<?php

namespace App\Providers;

use App\Actions\Auth\DeleteUser;
use App\Actions\Auth\LogoutUser;
use App\Actions\Auth\CreateNewUser;
use App\Actions\Auth\AuthenticateUser;
use App\Actions\Auth\ResetUserPassword;
use App\Actions\Auth\UpdateUserProfile;
use Illuminate\Support\ServiceProvider;
use App\Actions\Auth\UpdateUserPassword;
use Cratespace\Sentinel\Providers\Traits\HasActions;
use Cratespace\Sentinel\Contracts\Actions\DeletesUsers;
use Cratespace\Sentinel\Contracts\Actions\LogsoutUsers;
use Cratespace\Sentinel\Contracts\Actions\CreatesNewUsers;
use Cratespace\Sentinel\Contracts\Actions\AuthenticatesUsers;
use Cratespace\Sentinel\Contracts\Actions\ResetsUserPasswords;
use Cratespace\Sentinel\Contracts\Actions\UpdatesUserProfiles;
use Cratespace\Sentinel\Contracts\Actions\UpdatesUserPasswords;

class SentinelServiceProvider extends ServiceProvider
{
    use HasActions;

    /**
     * The sentinel action classes.
     *
     * @var array
     */
    protected $actions = [
        AuthenticatesUsers::class => AuthenticateUser::class,
        CreatesNewUsers::class => CreateNewUser::class,
        ResetsUserPasswords::class => ResetUserPassword::class,
        UpdatesUserPasswords::class => UpdateUserPassword::class,
        UpdatesUserProfiles::class => UpdateUserProfile::class,
        DeletesUsers::class => DeleteUser::class,
        LogsoutUsers::class => LogoutUser::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerActions();
    }
}
