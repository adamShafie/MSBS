<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TipsController;

//LoginController
route::get('/', [LoginController::class, 'home']);

route::get('/home', [LoginController::class, 'index']) ->name('home');

route::get('/logout', [LoginController::class, 'logout']) ->name('logout');


//TipsController
route::get('/add_inspection_tips', [TipsController::class, 'add_inspection_tips']) ->name('add_inspection_tips');

route::post('/save_inspection_tips', [TipsController::class, 'save_inspection_tips']) ->name('save_inspection_tips');

route::get('/manage_inspection_tips', [TipsController::class, 'manage_inspection_tips']) ->name('manage_inspection_tips');

route::get('/edit_inspection_tips/{id}', [TipsController::class, 'edit_inspection_tips']) ->name('edit_inspection_tips');

route::post('/update_inspection_tips/{id}', [TipsController::class, 'update_inspection_tips']) ->name('update_inspection_tips');

route::get('/delete_inspection_tips/{id}', [TipsController::class, 'delete_inspection_tips']) ->name('delete_inspection_tips');

route::get('/inspection_tips_details/{id}', [TipsController::class, 'inspection_tips_details']) ->name('inspection_tips_details');
