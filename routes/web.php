<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Http\Controllers\ColorController;

Route::view('/', 'layouts.base');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


Route::get('/counter', Counter::class);

Route::get('/colors', [ColorController::class, 'index'])->name('color.index');
Route::get('/colors/create', [ColorController::class, 'create'])->name('color.create');
Route::post('/colors', [ColorController::class, 'storage' ])->name('color.storage');
Route::get('/colors/{color}/edit', [ColorController::class, 'edit'])->name('color.edit');
Route::patch('/colors/update', [ColorController::class, 'update'])->name('color.update');
Route::delete('/colors/{color}', [ColorController::class, 'destroy'])->name('delete');

