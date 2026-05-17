<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ChickenController;
use App\Http\Controllers\Caretaker\CareController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.chickens.index');
    }
    return redirect()->route('caretaker.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Route Group
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('chickens', ChickenController::class);
});

// Caretaker Route Group
Route::middleware(['auth', 'caretaker'])->prefix('caretaker')->name('caretaker.')->group(function () {
    Route::get('/dashboard', [CareController::class, 'dashboard'])->name('dashboard');
    Route::get('/chickens/{chicken}/log/create', [CareController::class, 'create'])->name('chickens.create-log');
    Route::post('/chickens/{chicken}/log', [CareController::class, 'store'])->name('chickens.store-log');
    Route::get('/chickens/{chicken}/log', [CareController::class, 'show'])->name('chickens.show-log');
});

require __DIR__.'/auth.php';
