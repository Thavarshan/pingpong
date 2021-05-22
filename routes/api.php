<?php

use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RunController;

Route::group([
    'middleware' => ['auth:sentinel'],
], function () {
    Route::get('/contacts', fn () => response(Contact::all(), 200));
    Route::post('/log', [RunController::class, 'store']);
});
