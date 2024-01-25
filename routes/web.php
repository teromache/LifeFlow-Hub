<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SpendingTrackerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AuthController::class, 'showLoginForm'])->name('mainpage');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dasboard', [DashboardController::class, 'index'])->name('index.dashboard');
    Route::get('/spending', [SpendingTrackerController::class, 'index'])->name('index.spending');
    Route::get('/spending/{id}', [SpendingTrackerController::class, 'getSpendingDetails'])->name('get.spending.details');
    Route::post('/spending/add', [SpendingTrackerController::class, 'addSpending'])->name('add.spending');
    Route::post('/spending/update/{id}', [SpendingTrackerController::class, 'editSpending'])->name('update.spending');
    Route::post('/spending/delete/{id}', [SpendingTrackerController::class, 'deleteSpending'])->name('delete.spending');
});
