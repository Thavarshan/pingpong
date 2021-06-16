<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::group([
    'middleware' => ['auth:scorch'],
], function (): void {
    Route::get('/contacts', [ContactController::class, 'index']);
});
