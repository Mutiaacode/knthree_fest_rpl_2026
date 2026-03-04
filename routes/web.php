<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Models\Project;

Route::get('/', function () {
    $projects = Project::latest()->get();
    return view('welcome', compact('projects'));
})->name('home');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class , 'showLogin'])->name('login');
    Route::post('login', [AuthController::class , 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class , 'logout'])->name('logout');

    // Dashboard & CRUD
    Route::get('dashboard', [ProjectController::class , 'index'])->name('dashboard');
    Route::resource('projects', ProjectController::class)->except(['index', 'show']);
});
