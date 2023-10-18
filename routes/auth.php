<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, '_auth'])->name('views.login');
Route::get('/forgot', [AuthController::class, '_forgot'])->name('views.forgot');
Route::get('/reset/{token}', [AuthController::class, '_reset'])->name('views.reset');

Route::post('/login', [AuthController::class, 'auth'])->name('actions.login');
Route::post('/forgot', [AuthController::class, 'forgot'])->name('actions.forgot');
Route::post('/reset/{token}', [AuthController::class, 'reset'])->name('actions.reset');
