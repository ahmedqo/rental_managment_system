<?php

use App\Functions\FileFunction;
use Illuminate\Support\Facades\Route;


Route::get('/files/{id}/delete', function ($id) {
    FileFunction::destroy($id, true);
})->name('actions.files.destroy');
