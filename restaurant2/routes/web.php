<?php

use App\Http\Controllers\WebController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\MenuItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UIcontroller;

// Public customer routes (UI)
Route::get('/', [WebController::class, 'home']);
Route::get('/About', [WebController::class, 'about']);

//ui
Route::get('/location', [UIcontroller::class, 'location'])->name('location');

// Route to show the login page
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
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    
    // Admin manage menu
    Route::get('/admin/manage-menu', [AdminUserController::class, 'manageMenu'])->name('admin.manage-menu');
    Route::post('/admin/menu-items', [MenuItemController::class, 'store'])->name('admin.menu-items.store');
    Route::get('/admin/menu-items', [AdminUserController::class, 'indexMenuItems'])->name('admin.menu-items.index');
    Route::get('/admin/menu-items/{id}/edit', [MenuItemController::class, 'edit'])->name('admin.menu-items.edit');
    Route::put('/admin/menu-items/{id}', [MenuItemController::class, 'update'])->name('admin.menu-items.update');
    Route::delete('/admin/menu-items/{id}', [MenuItemController::class, 'destroy'])->name('admin.menu-items.destroy');

    

    //UI
});
