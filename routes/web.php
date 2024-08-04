<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $userAuth = auth()->user();

    return Inertia::render('Dashboard', [
        'userAuth' => $userAuth,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/animals')->group(function () {
        Route::get('/', [AnimalController::class, 'index'])->name('animals');
        Route::post('/create', [AnimalController::class, 'create'])->name('animals.create');
        Route::put('/update/{animalId}', [AnimalController::class, 'update'])->name('animals.update');
        Route::delete('/delete/{animalId}', [AnimalController::class, 'destroy'])->name('animals.destroy');
    });

    Route::prefix('/schedules')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('schedules');
        Route::post('/', [ScheduleController::class, 'index'])->name('schedules.post');
        Route::post('/create', [ScheduleController::class, 'create'])->name('schedules.create');
        Route::put('/update/{scheduleId}', [ScheduleController::class, 'update'])->name('schedules.update');
        Route::delete('/delete/{scheduleId}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');
        Route::put('/update/{scheduleId}/add-doctor', [ScheduleController::class, 'updateAddDoctor'])->name('schedules.update.add-doctor');
    });

    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::post('/create', [UserController::class, 'create'])->name('users.create');
        Route::put('/update/{userId}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/delete/{userId}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

require __DIR__.'/auth.php';
