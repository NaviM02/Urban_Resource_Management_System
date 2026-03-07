<?php

use App\Infrastructure\Http\Controllers\AuthController;
use App\Infrastructure\Http\Controllers\RouteController;
use App\Infrastructure\Http\Controllers\UserController;
use App\Infrastructure\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth', 'load.user')->name('dashboard');

// users
Route::middleware('auth')->group(function () {

    Route::get('/users', [UserController::class,'index'])->name('users.index');

    Route::get('/users/create', [UserController::class,'create'])->name('users.create');
    Route::post('/users', [UserController::class,'store'])->name('users.store');

    Route::get('/users/{id}', [UserController::class,'show'])->name('users.show');

    Route::get('/users/{id}/edit', [UserController::class,'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class,'update'])->name('users.update');

    Route::delete('/users/{id}', [UserController::class,'destroy'])->name('users.destroy');
});

// zones
Route::middleware('auth')->group(function () {

    Route::get('/zones', [ZoneController::class,'index'])->name('zones.index');

    Route::get('/zones/create', [ZoneController::class,'create'])->name('zones.create');
    Route::post('/zones', [ZoneController::class,'store'])->name('zones.store');

    Route::get('/zones/{id}', [ZoneController::class,'show'])->name('zones.show');

    Route::get('/zones/{id}/edit', [ZoneController::class,'edit'])->name('zones.edit');
    Route::put('/zones/{id}', [ZoneController::class,'update'])->name('zones.update');

    Route::delete('/zones/{id}', [ZoneController::class,'destroy'])->name('zones.destroy');
});

// routes
Route::middleware('auth')->group(function () {

    Route::get('/routes', [RouteController::class,'index'])->name('routes.index');

    Route::get('/routes/create', [RouteController::class,'create'])->name('routes.create');
    Route::post('/routes', [RouteController::class,'store'])->name('routes.store');

    Route::get('/routes/{id}', [RouteController::class,'show'])->name('routes.show');

    Route::get('/routes/{id}/edit', [RouteController::class,'edit'])->name('routes.edit');
    Route::put('/routes/{id}', [RouteController::class,'update'])->name('routes.update');

    Route::delete('/routes/{id}', [RouteController::class,'destroy'])->name('routes.destroy');
});
