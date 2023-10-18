<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/guest.php';

Route::group(["prefix" => "admin"], function () {
    Route::group(['middleware' => ['guest']], function () {
        require __DIR__ . '/auth.php';
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('actions.logout');
        require __DIR__ . '/system.php';
        require __DIR__ . '/profile.php';
        require __DIR__ . '/user.php';
        require __DIR__ . '/property.php';
        require __DIR__ . '/file.php';
        require __DIR__ . '/reservation.php';
    });
});
