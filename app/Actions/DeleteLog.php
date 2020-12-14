<?php

namespace App\Actions;

use App\Models\Run;
use App\Contracts\DeletesLogs;

class DeleteLog implements DeletesLogs
{
    /**
     * Delete all saved resources.
     *
     * @return mixed
     */
    public function deleteAll()
    {
        Run::all()->each->delete();
    }
}
