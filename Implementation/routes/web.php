<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Entreprise\AuthController;
use App\Http\Controllers\Entreprise\DashboardController;
use App\Http\Controllers\Entreprise\RessourceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Breeze default routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Entreprise-specific routes
Route::prefix('entreprise')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('entreprise.login');
    Route::post('/login', [AuthController::class, 'login'])->name('entreprise.login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('entreprise.register');
    Route::post('/register', [AuthController::class, 'register'])->name('entreprise.register.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('entreprise.logout');
});

// Protected Entreprise Routes with Spatie role check
Route::middleware(['auth', 'entreprise'])->prefix('entreprise')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('entreprise.dashboard');
    Route::get('/ressources', [RessourceController::class, 'index'])->name('entreprise.ressources.index');
    Route::get('/ressources/create', [RessourceController::class, 'create'])->name('entreprise.ressources.create');
    Route::post('/ressources', [RessourceController::class, 'store'])->name('entreprise.ressources.store');
});

// Admin routes with Spatie role check
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/entreprises', [AdminController::class, 'entreprises'])->name('admin.entreprises');
    Route::post('/entreprises/{id}/valider', [AdminController::class, 'validerEntreprise'])->name('admin.entreprises.valider');
    Route::post('/entreprises/{id}/rejeter', [AdminController::class, 'rejeterEntreprise'])->name('admin.entreprises.rejeter');
});

require __DIR__.'/auth.php';
