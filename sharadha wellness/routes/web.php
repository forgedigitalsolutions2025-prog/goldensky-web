<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/treatments', [TreatmentController::class, 'index'])->name('treatments');
Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');





