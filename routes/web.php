<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\EmailVerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

// Spa routes
Route::prefix('spa')->name('spa.')->group(function () {
    Route::get('/', [SpaController::class, 'index'])->name('home');
    Route::get('/about', [SpaController::class, 'about'])->name('about');
    Route::get('/about', [SpaController::class, 'about'])->name('about');
    Route::get('/treatments', [SpaController::class, 'treatments'])->name('treatments');
    Route::get('/pricing', [SpaController::class, 'pricing'])->name('pricing');
    Route::get('/contact', [SpaController::class, 'contact'])->name('contact');
    Route::post('/booking', [SpaController::class, 'storeBooking'])->name('booking.store');
    Route::post('/contact', [SpaController::class, 'storeContact'])->name('contact.store');
    Route::post('/newsletter', [SpaController::class, 'storeNewsletter'])->name('newsletter.store');
});

// Booking routes - Require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/success/{bookingId}', [BookingController::class, 'success'])->name('bookings.success');
});

// Profile routes - Require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('/profile/bookings/{bookingId}/cancel', [ProfileController::class, 'cancelBooking'])->name('profile.booking.cancel');
});

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Google OAuth routes
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Admin panel routes (hidden - access via double-click © in footer)
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/inventory-requests', [AdminController::class, 'inventoryRequestsIndex'])->name('admin.inventory-requests');
Route::post('/admin/inventory-requests/{id}/approve', [AdminController::class, 'approveInventoryRequest'])->name('admin.inventory-requests.approve');
Route::post('/admin/inventory-requests/{id}/reject', [AdminController::class, 'rejectInventoryRequest'])->name('admin.inventory-requests.reject');

// Email verification routes
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', EmailVerificationController::class)
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');
Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// Chatbot routes
Route::post('/api/chat', [\App\Http\Controllers\ChatController::class, 'chat'])->name('chat.send');






