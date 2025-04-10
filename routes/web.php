<?php

use App\Http\Middleware\ProjectsList;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/dashboard', function () {
    return redirect('/');
});

Route::get(
    '/', [DashboardController::class, 'index']
)->middleware(['auth', ProjectsList::class])->name('dashboard');

Route::middleware(['auth', ProjectsList::class])->group(function() {
    Route::prefix('project')->group(function() {
        Route::get('/{id}', [ProjectController::class, 'find'])->name('project.index');
        Route::get('/', function() { return view('form_project'); })->name('project.store');
        Route::post('/', [ProjectController::class, 'store'])->name('project.store');
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('project.edit');
        Route::put('/{project}', [ProjectController::class, 'update'])->name('project.update');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('project.destroy');
    });

    Route::prefix('tasks')->group(function() {
        Route::get('/create/{project}', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/store/{project}', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/edit/{task}', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::put('/update/{task}', [TaskController::class, 'update'])->name('tasks.update');
        Route::put('/update-status/{task}', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
        Route::delete('/delete/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    });

    Route::middleware(['role:admin'])->group(function() {
        Route::resource('users', UserController::class);
    });
});

Route::get('/test-alert', function () {
    session()->flash('success', 'Test alert muncul!');
    return view('welcome'); // atau view lain yang pakai layout sama
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
