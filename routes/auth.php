<?php

use App\Http\Controllers\Auth\AuthenticatedUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest')->name('register');
Route::post('/login', [AuthenticatedUserController::class, 'store'])->middleware('guest')->name('login');