<?php

namespace App\Http\Controllers;

use App\Models\Run;
use App\Contracts\DeletesLogs;

class RunLogController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Run $log
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Run $log)
    {
        $log->delete();

        return back()->with('status', 'log-deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Run $log
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyAll(DeletesLogs $deletor)
    {
        $deletor->deleteAll();

        return back()->with('status', 'logs-deleted');
    }
}
