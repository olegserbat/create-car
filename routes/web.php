<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Http\Controllers\ColorController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarStockController;

Route::view('/', 'main')->name('main');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';



Route::get('/colors', [ColorController::class, 'index'])->name('color.index')->middleware('auth');
Route::get('/colors/create', [ColorController::class, 'create'])->name('color.create')->middleware('auth');
Route::post('/colors', [ColorController::class, 'storage' ])->name('color.storage')->middleware('auth');
Route::get('/colors/{color}/edit', [ColorController::class, 'edit'])->name('color.edit')->middleware('auth');
Route::patch('/colors/update', [ColorController::class, 'update'])->name('color.update')->middleware('auth');
Route::delete('/colors/{color}', [ColorController::class, 'destroy'])->name('color.delete')->middleware('auth');

Route::get('/brends', 'App\Http\Controllers\BrendController@index')->name('brend.index')->middleware('auth');
Route::get('/brends/create', 'App\Http\Controllers\BrendController@create')->name('brend.create')->middleware('auth');
Route::post('/brends', 'App\Http\Controllers\BrendController@store')->name('brend.storage')->middleware('auth');
Route::get('/brends/{brend}/edit', 'App\Http\Controllers\BrendController@edit')->name('brend.edit')->middleware('auth');
Route::patch('/brends/update', 'App\Http\Controllers\BrendController@update')->name('brend.update')->middleware('auth');
Route::delete('/brends/{brend}', 'App\Http\Controllers\BrendController@destroy')->name('brend.delete')->middleware('auth');


// Остальные действия — только для авторизованных
Route::middleware(['auth'])->group(function () {
    Route::resource('cars', CarController::class)->except(['index', 'show']);
});

// Просмотр списка и отдельного автомобиля — доступен всем
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');


// только для авторизованных:
Route::middleware(['auth'])->group(function () {
    Route::post('/car-stocks', [CarStockController::class, 'store'])->name('car-stock.store');
    Route::get('/car-stocks/create', [CarStockController::class, 'create'])->name('car-stock.create');
    Route::get('/car-stocks/{carStock}/edit', [CarStockController::class, 'edit'])->name('car-stock.edit');
    Route::patch('/car-stocks/{carStock}', [CarStockController::class, 'update'])->name('car-stock.update');
    Route::delete('/car-stocks/{carStock}', [CarStockController::class, 'destroy'])->name('car-stock.destroy');
});

Route::get('/car-stocks', [CarStockController::class, 'index'])->name('car-stock.index');
Route::get('/car-stocks/{carStock}', [CarStockController::class, 'show'])->name('car-stock.show');
