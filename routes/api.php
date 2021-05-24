<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\TakeBookController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('/books', BookController::class);
    Route::apiResource('/take/book', TakeBookController::class)->only(['store'])->names('take.book');
    Route::apiResource('/authors', AuthorController::class);
});
