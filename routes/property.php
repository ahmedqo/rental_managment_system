<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;


Route::get('/properties', [PropertyController::class, 'index'])->name('views.properties.index');
Route::get('/properties/create', [PropertyController::class, 'create'])->name('views.properties.create');
Route::get('/properties/{id}/edit', [PropertyController::class, 'edit'])->name('views.properties.edit');

Route::post('/properties/create', [PropertyController::class, 'store'])->name('actions.properties.create');
Route::post('/properties/{id}/update', [PropertyController::class, 'update'])->name('actions.properties.edit');
Route::get('/properties/{id}/delete', [PropertyController::class, 'destroy'])->name('actions.properties.destroy');
