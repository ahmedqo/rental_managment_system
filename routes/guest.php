<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SystemController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PropertyController::class, 'all'])->name("views.home.show");
Route::get('/terms', [SystemController::class, 'terms'])->name("views.terms.show");
Route::get('/properties/{slug}', [PropertyController::class, 'show'])->name("views.property.show");

Route::post('/properties/search', [PropertyController::class, 'search'])->name('actions.properties.search');
Route::post('/properties/{id}/reservations/create', [ReservationController::class, 'store'])->name('actions.reservations.create');

Route::post('/contact/create', [SystemController::class, 'contact'])->name('actions.home.contact');
Route::get('/back/{name}/{token}', [SystemController::class, 'store'])->name('actions.home.back');
