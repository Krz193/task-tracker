<?php

use App\Http\Middleware\ProjectsList;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;

Route::get('/dashboard', function () {
    return redirect('/');
});

Route::get(
    '/', [ProjectController::class, 'index']
)->middleware(['auth', 'verified', ProjectsList::class])->name('dashboard');

Route::middleware(['auth', 'verified', ProjectsList::class])->group(function() {
    Route::get('/project/{id}', [ProjectController::class, 'find'])->name('project.index');

    Route::get('/project', function() { return view('form_project'); })->name('project.store');
    Route::post('/project', [ProjectController::class, 'store'])->name('project.store');

    Route::get('/project/{project}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::put('/project/{project}', [ProjectController::class, 'update'])->name('project.update');

    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('project.destroy');

    Route::prefix('tasks')->middleware(['auth'])->group(function() {
        Route::get('/tasks/create/{project}', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/store/{project}', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/edit/{task}', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::put('/update/{task}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('/delete/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
        Route::put('/update-status/{task}', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
