<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RunController;
use App\Http\Controllers\ContactController;

Route::group([
    'middleware' => ['auth:sentinel'],
], function () {
    Route::get('/contacts', [ContactController::class, 'index']);
    Route::post('/logs', [RunController::class, 'store']);
});
