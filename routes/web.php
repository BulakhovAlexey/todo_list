<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AboutController::class, 'index'])->name('about.index');
Route::resource('/tasks', TaskController::class);
