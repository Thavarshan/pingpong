<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactAddressController;

Route::get('/', fn () => redirect('/login'))->name('welcome');

Route::group([
    'middleware' => ['auth:scorch', 'verified'],
], function (): void {
    Route::resource('contacts', ContactController::class);
    Route::post('/contacts/{contact}/address', ContactAddressController::class)->name('contacts.address');
});
