<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacancyController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/companyprofile', [ProfileController::class, 'updatecompany'])->name('profile.updatecompany');

    Route::get('vacancies/data', [VacancyController::class, 'data'])->name('vacancies.data');

    Route::middleware([RoleMiddleware::class . ':Company'])->group(function () {
        Route::get('vacancies', [VacancyController::class, 'index'])->name('vacancies.index');
        Route::get('vacancies/create', [VacancyController::class, 'create'])->name('vacancies.create');
        Route::post('vacancies', [VacancyController::class, 'store'])->name('vacancies.store');
    });
    Route::get('vacancies/{vacancy}', [VacancyController::class, 'show'])->name('vacancies.show');
    Route::middleware([RoleMiddleware::class . ':Admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/vacancies', [AdminController::class, 'vacancies'])->name('admin.vacancies');
    });
    Route::middleware([RoleMiddleware::class . ':Admin,Company'])->group(function () {
        Route::get('vacancies/{vacancy}/edit', [VacancyController::class, 'edit'])->name('vacancies.edit');
        Route::put('vacancies/{vacancy}', [VacancyController::class, 'update'])->name('vacancies.update');
        Route::delete('vacancies/{vacancy}', [VacancyController::class, 'destroy'])->name('vacancies.destroy');
    });
});

require __DIR__ . '/auth.php';
