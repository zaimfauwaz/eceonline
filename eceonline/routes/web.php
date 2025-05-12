<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('welcome');})->name('welcome');

Auth::routes();

Route::get('/loginas', [App\Http\Controllers\LoginAsController::class, 'index'])->name('loginas');

Route::resource('/cars', App\Http\Controllers\CarController::class);
Route::resource('/bookings', App\Http\Controllers\BookingController::class);
Route::resource('/branches', App\Http\Controllers\BranchController::class);
Route::resource('/users', App\Http\Controllers\UserController::class);