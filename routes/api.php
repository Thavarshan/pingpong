<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RunLogsController;
use App\Http\Controllers\Api\StudentController;

/* Test Route */
Route::middleware(['api', 'ext-app'])->get('/ping', fn () => 'ping');

Route::middleware(['api', 'ext-app'])->get(
    '/students', [StudentController::class, 'index']
);

Route::middleware(['api', 'ext-app'])->post(
    '/log/run', [RunLogsController::class, 'store']
);
