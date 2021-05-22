<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => Inertia::render('Welcome/Show'))->name('welcome');

Route::group([
    'middleware' => ['auth:sentinel', 'verified'],
], function (): void {
    Route::get('/home', fn () => Inertia::render('Business/Home'))->name('home');
});
