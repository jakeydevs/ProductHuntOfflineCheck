<?php

use App\Http\Controllers\HuntController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HuntController::class, 'get'])->name('index');
Route::get('test', [HuntController::class, 'test'])->name('test');
