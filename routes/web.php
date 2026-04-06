<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SubmissionController;
use App\Models\Project;

// =============================================
// HALAMAN PUBLIK
// =============================================

// Landing page — hanya tampilkan project yang ACCEPTED
Route::get('/', function () {
    $projects = Project::accepted()->latest()->get();
    return view('welcome', compact('projects'));
})->name('home');

// Form upload siswa (tanpa login)
Route::get('/upload', [SubmissionController::class, 'create'])->name('submit.form');
Route::post('/upload', [SubmissionController::class, 'store'])->name('submit.store');
Route::get('/upload/sukses', [SubmissionController::class, 'success'])->name('submit.success');

// =============================================
// ADMIN 
// =============================================

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard & CRUD project
    Route::get('dashboard', [ProjectController::class, 'index'])->name('dashboard');
    Route::resource('projects', ProjectController::class)->except(['index', 'show']);

    // Review submission siswa: accept / reject
    Route::patch('projects/{project}/accept', [ProjectController::class, 'accept'])->name('projects.accept');
    Route::patch('projects/{project}/reject', [ProjectController::class, 'reject'])->name('projects.reject');
});
