<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('views.profile.edit');
Route::post('/profile/edit', [ProfileController::class, 'update'])->name('actions.profile.edit');

Route::get('/profile/password/edit', [ProfileController::class, 'password'])->name('views.profile.password');
Route::post('/profile/password/edit', [ProfileController::class, 'change'])->name('actions.profile.password');
