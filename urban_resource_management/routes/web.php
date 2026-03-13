<?php

use App\Infrastructure\Http\Controllers\AuthController;
use App\Infrastructure\Http\Controllers\CollectionController;
use App\Infrastructure\Http\Controllers\GreenPointController;
use App\Infrastructure\Http\Controllers\MaterialDeliveryController;
use App\Infrastructure\Http\Controllers\RouteController;
use App\Infrastructure\Http\Controllers\TruckController;
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

// trucks
Route::middleware('auth')->group(function () {

    Route::get('/trucks', [TruckController::class,'index'])->name('trucks.index');

    Route::get('/trucks/create', [TruckController::class,'create'])->name('trucks.create');
    Route::post('/trucks', [TruckController::class,'store'])->name('trucks.store');

    Route::get('/trucks/{id}', [TruckController::class,'show'])->name('trucks.show');

    Route::get('/trucks/{id}/edit', [TruckController::class,'edit'])->name('trucks.edit');
    Route::put('/trucks/{id}', [TruckController::class,'update'])->name('trucks.update');

    Route::delete('/trucks/{id}', [TruckController::class,'destroy'])->name('trucks.destroy');
});

// collections
Route::middleware('auth')->group(function () {

    Route::get('/collections', [CollectionController::class,'index'])->name('collections.index');

    Route::get('/collections/create', [CollectionController::class,'create'])->name('collections.create');
    Route::post('/collections', [CollectionController::class,'store'])->name('collections.store');

    Route::get('/collections/{id}', [CollectionController::class,'show'])->name('collections.show');

    Route::post('/collections/{id}/start', [CollectionController::class,'start'])->name('collections.start');

    Route::post('/collections/{id}/finish', [CollectionController::class,'finish'])->name('collections.finish');

    Route::post('/collections/{id}/cancel', [CollectionController::class,'cancel'])->name('collections.cancel');

    Route::post('/collections/{id}/incidence', [CollectionController::class,'addIncidence'])->name('collections.incidence');

});

// green points
Route::middleware('auth')->group(function () {

    Route::get('/green-points', [GreenPointController::class,'index'])
        ->name('green-points.index');

    Route::get('/green-points-map', [GreenPointController::class,'map'])
        ->name('green-points-map.index');

    Route::post('/containers/empty', [GreenPointController::class,'emptyContainer'])
        ->name('containers.empty');

    Route::get('/green-points/create', [GreenPointController::class,'create'])
        ->name('green-points.create');

    Route::post('/green-points', [GreenPointController::class,'store'])
        ->name('green-points.store');

    Route::get('/green-points/{id}', [GreenPointController::class,'show'])
        ->name('green-points.show');

    Route::get('/green-points/{id}/edit', [GreenPointController::class,'edit'])
        ->name('green-points.edit');

    Route::put('/green-points/{id}', [GreenPointController::class,'update'])
        ->name('green-points.update');

    Route::post('/green-points/delivery', [GreenPointController::class,'registerDelivery'])
        ->name('green-points.delivery');

    Route::delete('/green-points/{id}', [GreenPointController::class,'destroy'])
        ->name('green-points.destroy');

});


