<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Http\Controllers\ColorController;
use Illuminate\Auth\Middleware\Authenticate;

Route::view('/', 'layouts.base');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


Route::get('/counter', Counter::class);

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

