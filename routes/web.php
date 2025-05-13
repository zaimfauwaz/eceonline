<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginAsController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UserController;

Route::get('/', function () {return view('welcome');})->name('welcome');

Auth::routes();

Route::get('loginas', [App\Http\Controllers\LoginAsController::class, 'index'])->name('loginas');

Route::resource('car', App\Http\Controllers\CarController::class);
Route::resource('booking', App\Http\Controllers\BookingController::class);
Route::resource('branch', App\Http\Controllers\BranchController::class);
Route::resource('user', App\Http\Controllers\UserController::class);
