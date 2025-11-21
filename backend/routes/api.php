<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello', function () {
    return response()->json(['message' => 'Hello from Laravel API!']);
});

Route::apiResource('blog', BlogController::class);
Route::get('/userblog/{id}', [BlogController::class, 'userblog']);
Route::get('/userblog', [BlogController::class, 'currentuserblog']);
Route::get('/searchblog', [BlogController::class, 'search']);

Route::post('/signup', [LoginController::class, 'signup']);

Route::post('/login', [LoginController::class, 'login']);
Route::get('/nologin', [LoginController::class, 'nologin'])->name('login');


// Route::post('/todos/store', [TodoController::class, 'store'])->name('todos.store');
// Route::apiResource('user', UserController::class);