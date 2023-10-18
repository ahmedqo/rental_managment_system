<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;


Route::get('/reservations', [ReservationController::class, 'index'])->name('views.reservations.index');
Route::get('/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('views.reservations.edit');

Route::post('/reservations/{id}/update', [ReservationController::class, 'update'])->name('actions.reservations.edit');
Route::get('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('actions.reservations.cancel');
Route::get('/reservations/{id}/active', [ReservationController::class, 'active'])->name('actions.reservations.active');
