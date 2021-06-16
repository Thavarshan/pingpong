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
use Emberfuse\Scorch\Providers\Traits\HasActions;
use Emberfuse\Scorch\Contracts\Actions\DeletesUsers;
use Emberfuse\Scorch\Contracts\Actions\LogsoutUsers;
use Emberfuse\Scorch\Contracts\Actions\CreatesNewUsers;
use Emberfuse\Scorch\Contracts\Actions\AuthenticatesUsers;
use Emberfuse\Scorch\Contracts\Actions\ResetsUserPasswords;
use Emberfuse\Scorch\Contracts\Actions\UpdatesUserProfiles;
use Emberfuse\Scorch\Contracts\Actions\UpdatesUserPasswords;

class ScorchServiceProvider extends ServiceProvider
{
    use HasActions;

    /**
     * The scorch action classes.
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
