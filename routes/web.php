<?php

use App\Models\Run;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RunController;
use App\Http\Controllers\ContactController;

Route::get('/', fn () => redirect('/login'))->name('welcome');

Route::group([
    'middleware' => ['auth:sentinel', 'verified'],
], function (): void {
    Route::get('/home', function () {
        return Inertia::render('Business/Home', [
            'logs' => Run::where('user_id', auth()->id())->with('contacts')->latest()->get(),
            'contacts' => auth()->user()->contacts->count(),
            'runs' => auth()->user()->runs->count(),
        ]);
    })->name('home');

    Route::resource('runs', RunController::class);
    Route::resource('contacts', ContactController::class);
});
