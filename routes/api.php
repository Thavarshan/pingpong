<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\BirthdayLogsController;

Route::middleware(['api', 'ext-app'])->get(
    '/students', [StudentController::class, 'index']
);

Route::middleware(['api', 'ext-app'])->post(
    '/log/birthdays', [BirthdayLogsController::class, 'store']
);
