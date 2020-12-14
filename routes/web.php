<?php

use App\Models\Run;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RunLogController;

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'logs' => Run::latest()->paginate(10),
        ]);
    })->name('dashboard');

    Route::get('/logs/{log}', [RunLogController::class, 'destroy'])->name('log.destroy');

    Route::delete('/logs', [RunLogController::class, 'destroyAll'])->name('logs.destroy');
});

require __DIR__ . '/auth.php';
