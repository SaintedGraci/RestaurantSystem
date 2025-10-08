<?php

use App\Http\Controllers\WebController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Public customer routes (UI)
Route::get('/', [WebController::class, 'home']);
Route::get('/About', [WebController::class, 'about']);

// Authentication routes for login and logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin dashboard routes (protected by role: admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Admin-only: create accounts
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{admin}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{admin}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{admin}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    
    // Admin manage menu
    Route::get('/admin/manage-menu', [AdminUserController::class, 'manageMenu'])->name('admin.manage-menu');
});
