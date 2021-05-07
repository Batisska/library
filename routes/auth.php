<?php

use App\Http\Controllers\Auth\AuthenticatedUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register')->middleware('guest');
Route::post('/login', [AuthenticatedUserController::class, 'store'])->name('login')->middleware('guest');
