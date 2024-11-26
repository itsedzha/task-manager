<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubtaskController;

Route::patch('/subtasks/{subtask}', [SubtaskController::class, 'update'])->name('subtasks.update');
Route::delete('/subtasks/{subtask}', [SubtaskController::class, 'destroy'])->name('subtasks.destroy');

Route::resource('tasks', TaskController::class);

Route::get('/', function () {
    return view('welcome');
});
