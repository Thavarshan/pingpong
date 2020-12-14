<?php

namespace App\Contracts;

interface DeletesLogs
{
    /**
     * Delete all saved resources.
     *
     * @return mixed
     */
    public function deleteAll();
}
