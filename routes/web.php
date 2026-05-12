<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\LocationController as AdminLocationController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;


// --- Public Routes ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// --- Customer Auth Routes ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/history', [BookingController::class, 'history'])->name('bookings.history');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    
    Route::get('/bookings/{booking}/confirmation', [BookingController::class, 'confirmation'])->name('bookings.confirmation');
    Route::get('/bookings/{booking}/download-pdf', [BookingController::class, 'downloadPdf'])->name('bookings.download-pdf');
    Route::get('/bookings/{booking}/payment', [PaymentController::class, 'show'])->name('bookings.payment');
    Route::post('/bookings/{booking}/payment', [PaymentController::class, 'process'])->name('bookings.payment.process');
    
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// --- Admin Routes ---
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('cars', AdminCarController::class);
    Route::post('cars/{car}/toggle', [AdminCarController::class, 'toggleAvailability'])->name('cars.toggle');
    
    // Contact Messages Management
    Route::post('/contacts/{contact}/read', [ContactController::class, 'markAsRead'])->name('contacts.read');    
    Route::resource('contacts', ContactController::class)->only(['index', 'destroy']);

    Route::resource('bookings', AdminBookingController::class);
    Route::patch('bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.updateStatus');

    Route::resource('users', AdminUserController::class);
    Route::post('users/{user}/toggle', [AdminUserController::class, 'toggleStatus'])->name('users.toggle');

    Route::resource('locations', AdminLocationController::class);
});

// --- Auth Routes ---
require __DIR__.'/auth.php';