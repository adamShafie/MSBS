<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\ServiceHistoryController;

// LoginController
Route::get('/', [LoginController::class, 'home']);
Route::get('/home', [LoginController::class, 'index'])->name('home');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// ProfileController
Route::get('/user_details', [ProfileController::class, 'view_profile'])->name('view_profile');
Route::get('/edit_profile/{id}', [ProfileController::class, 'edit_profile'])->name('edit_profile');
Route::post('/update_profile/{id}', [ProfileController::class, 'update_profile'])->name('update_profile');
Route::get('/delete_profile/{id}', [ProfileController::class, 'delete_profile'])->name('delete_profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/motorcycle_details', [ProfileController::class, 'view_motorcycle'])->name('view_motorcycle');
    Route::get('/edit_motorcycle/{id}', [ProfileController::class, 'edit_motorcycle'])->name('edit_motorcycle');
    Route::post('/update_motorcycle/{id}', [ProfileController::class, 'update_motorcycle'])->name('update_motorcycle');
    Route::get('/add_motorcycle', [ProfileController::class, 'add_motorcycle'])->name('add_motorcycle');
    Route::post('/save_motorcycle', [ProfileController::class, 'save_motorcycle'])->name('save_motorcycle');
    Route::get('/delete_motorcycle/{id}', [ProfileController::class, 'delete_motorcycle'])->name('delete_motorcycle');
});

// TipsController
Route::controller(TipsController::class)->group(function () {
    Route::get('/add_inspection_tips', 'add_inspection_tips')->name('add_inspection_tips');
    Route::post('/save_inspection_tips', 'save_inspection_tips')->name('save_inspection_tips');
    Route::get('/manage_inspection_tips', 'manage_inspection_tips')->name('manage_inspection_tips');
    Route::get('/edit_inspection_tips/{id}', 'edit_inspection_tips')->name('edit_inspection_tips');
    Route::post('/update_inspection_tips/{id}', 'update_inspection_tips')->name('update_inspection_tips');
    Route::get('/delete_inspection_tips/{id}', 'delete_inspection_tips')->name('delete_inspection_tips');
    Route::get('/view_inspection_tips', 'view_inspection_tips')->name('view_inspection_tips');
    Route::get('/inspection_tips_details/{id}', 'inspection_tips_details')->name('inspection_tips_details');
});

// BookingController
Route::middleware(['auth'])->group(function () {
    Route::get('/view_bookings', [BookingController::class, 'view_bookings'])->name('view_bookings');
    Route::get('/service_booking', [BookingController::class, 'service_booking'])->name('service_booking');
    Route::post('/save_booking', [BookingController::class, 'save_booking'])->name('save_booking');
    Route::get('/edit_booking/{id}', [BookingController::class, 'edit_booking'])->name('edit_booking');
    Route::post('/update_booking/{id}', [BookingController::class, 'update_booking'])->name('update_booking');
    Route::get('/delete_booking/{id}', [BookingController::class, 'delete_booking'])->name('delete_booking');
    Route::get('/make_payment/{id}', [BookingController::class, 'make_payment'])->name('make_payment');
    Route::get('/my-bookings', [BookingController::class, 'view_bookings'])->name('my_bookings');
    Route::get('/available-slots', [BookingController::class, 'getAvailableSlots'])->name('available_slots');
    Route::post('/stripe/{id}', [BookingController::class, 'stripePost'])->name('stripe.post');
});

// ApprovalController
Route::controller(ApprovalController::class)->group(function () {
    Route::get('/booking_details/{id}', 'booking_details')->name('booking_details');
    Route::post('/set_price/{id}', 'set_price')->name('set_price');
    Route::post('/approve_booking/{id}', 'approve_booking')->name('approve_booking');
    Route::post('/reject_booking/{id}', 'reject_booking')->name('reject_booking');
});

// ServiceHistoryController
Route::controller(ServiceHistoryController::class)->group(function () {
    Route::get('/service_history', 'index')->name('service_history');
    Route::get('/add_record', 'add_record')->name('add_record');
    Route::post('/save_record', 'save_record')->name('save_record');
    Route::get('/edit_record/{id}', 'edit_record')->name('edit_record');
    Route::post('/update_record/{id}', 'update_record')->name('update_record');
    Route::get('/delete_record/{id}', 'delete_record')->name('delete_record');
});
