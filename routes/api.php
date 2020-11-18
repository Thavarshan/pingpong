<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;

Route::middleware(['api', 'ext-app'])
    ->get('/students', [StudentController::class, 'index']);
