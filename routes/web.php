<?php

use App\Http\Controllers\ApprovalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TipsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use Symfony\Component\HttpKernel\Profiler\Profile;

//LoginController
route::get('/', [LoginController::class, 'home']);

route::get('/home', [LoginController::class, 'index']) ->name('home');

route::get('/logout', [LoginController::class, 'logout']) ->name('logout');



//ProfileController
route::get('/user_details', [ProfileController::class, 'view_profile']) ->name('view_profile');

route::get('/edit_profile/{id}', [ProfileController::class, 'edit_profile']) ->name('edit_profile');

route::post('/update_profile/{id}', [ProfileController::class, 'update_profile']) ->name('update_profile');

route::get('/delete_profile/{id}', [ProfileController::class, 'delete_profile']) ->name('delete_profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/motorcycle_details', [ProfileController::class, 'view_motorcycle'])->name('view_motorcycle');
});

route::get('/edit_motorcycle/{id}', [ProfileController::class, 'edit_motorcycle']) ->name('edit_motorcycle');

route::post('/update_motorcycle/{id}', [ProfileController::class, 'update_motorcycle']) ->name('update_motorcycle');

route::get('/add_motorcycle', [ProfileController::class, 'add_motorcycle']) ->name('add_motorcycle');

Route::middleware(['auth'])->group(function () {
    Route::post('/save_motorcycle', [ProfileController::class, 'save_motorcycle'])->name('save_motorcycle');
});

route::get('/delete_motorcycle/{id}', [ProfileController::class, 'delete_motorcycle']) ->name('delete_motorcycle');


//TipsController
route::get('/add_inspection_tips', [TipsController::class, 'add_inspection_tips']) ->name('add_inspection_tips');

route::post('/save_inspection_tips', [TipsController::class, 'save_inspection_tips']) ->name('save_inspection_tips');

route::get('/manage_inspection_tips', [TipsController::class, 'manage_inspection_tips']) ->name('manage_inspection_tips');

route::get('/edit_inspection_tips/{id}', [TipsController::class, 'edit_inspection_tips']) ->name('edit_inspection_tips');

route::post('/update_inspection_tips/{id}', [TipsController::class, 'update_inspection_tips']) ->name('update_inspection_tips');

route::get('/delete_inspection_tips/{id}', [TipsController::class, 'delete_inspection_tips']) ->name('delete_inspection_tips');

route::get('/view_inspection_tips', [TipsController::class, 'view_inspection_tips']) ->name('view_inspection_tips');

route::get('/inspection_tips_details/{id}', [TipsController::class, 'inspection_tips_details']) ->name('inspection_tips_details');



//BookingController
Route::middleware(['auth'])->group(function () {
route::get('/view_bookings', [BookingController::class, 'view_bookings']) ->name('view_bookings');

route::get('/service_booking', [BookingController::class, 'service_booking'])->name('service_booking');

route::post('/save_booking', [BookingController::class, 'save_booking'])->name('save_booking');

route::get('/edit_booking/{id}', [BookingController::class, 'edit_booking']) ->name('edit_booking');

route::post('/update_booking/{id}', [BookingController::class, 'update_booking']) ->name('update_booking');

route::get('/delete_booking/{id}', [BookingController::class, 'delete_booking']) ->name('delete_booking');

route::get('/make_payment/{id}', [BookingController::class, 'make_payment']) ->name('make_payment');

Route::controller(BookingController::class)->group(function(){

    Route::post('stripe/{id}', [BookingController::class, 'stripePost'])->name('stripe.post');
});
});



//ApprovalController
route::get('/booking_details/{id}', [ApprovalController::class, 'booking_details']) ->name('booking_details');
route::post('/set_price/{id}', [ApprovalController::class, 'set_price']) ->name('set_price');
route::post('/approve_booking/{id}', [ApprovalController::class, 'approve_booking']) ->name('approve_booking');
route::post('/reject_booking/{id}', [ApprovalController::class, 'reject_booking']) ->name('reject_booking');
