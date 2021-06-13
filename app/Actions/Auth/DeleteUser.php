<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Emberfuse\Scorch\Contracts\Actions\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param \App\Models\User $user
     *
     * @return void
     */
    public function delete(User $user): void
    {
        DB::transaction(function () use ($user) {
            tap($user, function (User $user) {
                $this->deleteUserResources($user);

                $this->deleteUserProfiles($user);
            })->delete();
        }, 2);
    }

    /**
     * Delete all resources that belong to the user.
     *
     * @param \App\Models\User $user
     *
     * @return void
     */
    protected function deleteUserResources(User $user): void
    {
    }

    /**
     * Delete user profile details.
     *
     * @param \App\Models\User $user
     *
     * @return void
     */
    protected function deleteUserProfiles(User $user): void
    {
        $user->deleteProfilePhoto();

        $user->tokens->each->delete();
    }
}
