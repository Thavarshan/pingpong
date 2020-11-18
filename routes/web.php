<?php

use App\Models\Token;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $token = Token::create([
        'token' => Str::random(21),
    ]);

    return $token->token;
});
