<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NoticeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Public routes
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Employees
    Route::resource('employees', EmployeeController::class);
    
    // Notices
    Route::resource('notices', NoticeController::class);
    
    // Documents
    Route::resource('documents', DocumentController::class)->except(['show', 'edit', 'update']);
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('can:admin')->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('index');
    });
});
