<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioSettingsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Dashboard (auth required)
Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/messages', [DashboardController::class, 'messages'])->name('dashboard.messages');
    Route::patch('/messages/{contact}', [DashboardController::class, 'toggleRead'])->name('dashboard.messages.toggle');
    Route::delete('/messages/{contact}', [DashboardController::class, 'destroyMessage'])->name('dashboard.messages.destroy');

    // Portfolio Management
    Route::prefix('portfolio')->name('dashboard.portfolio.')->group(function () {
        Route::get('/hero', [PortfolioSettingsController::class, 'hero'])->name('hero');
        Route::get('/about', [PortfolioSettingsController::class, 'about'])->name('about');
        Route::post('/settings', [PortfolioSettingsController::class, 'updateSettings'])->name('settings.update');

        Route::get('/skills', [PortfolioSettingsController::class, 'skills'])->name('skills');
        Route::post('/skills', [PortfolioSettingsController::class, 'addSkill'])->name('skills.add');
        Route::patch('/skills/{skill}', [PortfolioSettingsController::class, 'updateSkill'])->name('skills.update');
        Route::delete('/skills/{skill}', [PortfolioSettingsController::class, 'deleteSkill'])->name('skills.delete');

        Route::get('/projects', [PortfolioSettingsController::class, 'projects'])->name('projects');
        Route::post('/projects', [PortfolioSettingsController::class, 'addProject'])->name('projects.add');
        Route::patch('/projects/{project}', [PortfolioSettingsController::class, 'updateProject'])->name('projects.update');
        Route::delete('/projects/{project}', [PortfolioSettingsController::class, 'deleteProject'])->name('projects.delete');

        Route::get('/library', [PortfolioSettingsController::class, 'library'])->name('library');
        Route::post('/library', [PortfolioSettingsController::class, 'addBook'])->name('library.add');
        Route::patch('/library/{book}', [PortfolioSettingsController::class, 'updateBook'])->name('library.update');
        Route::delete('/library/{book}', [PortfolioSettingsController::class, 'deleteBook'])->name('library.delete');
    });
});

// Profile management (auth required)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
