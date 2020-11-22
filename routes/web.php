<?php

use App\Models\Run;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'logs' => Run::latest()->paginate(10),
    ]);
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
