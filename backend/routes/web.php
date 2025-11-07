<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::apiResource('blog', BlogController::class);

// Route::apiResource('user', UserController::class);

// Route::get('/login', function () {
//     return Inertia::render('Welcome');
// })->name('home');