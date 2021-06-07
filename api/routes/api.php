<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonController;


Route::get('people', [PersonController::class, 'index']);
Route::get('people/{person}', [PersonController::class, 'show']);
Route::patch('people/{person}', [PersonController::class, 'update']);
Route::delete('people/{person}', [PersonController::class, 'destroy']);