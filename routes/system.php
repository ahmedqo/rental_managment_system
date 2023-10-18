<?php

use App\Http\Controllers\SystemController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [SystemController::class, 'index'])->name("views.dashboard.show");
Route::get('/settings', [SystemController::class, 'setting'])->name("views.settings.show");

Route::post('/settings', [SystemController::class, 'update'])->name("actions.settings.update");

