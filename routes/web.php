<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Crud\ConsumerController;
use App\Http\Controllers\Crud\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ConsumerController::class, 'index'])->middleware('guest')->name('consumer.home');

Route::get('/book-cylinder', [BookingController::class, 'bookCylinder'])->middleware('guest')->name('bookCylinderForm');
Route::post('/book-cylinder', [BookingController::class, 'store'])->middleware('guest')->name('bookCylinder');
Route::get('/get-supplier-by-state', [BookingController::class, 'getSupplierByState'])->middleware('guest')->name('state.supplier');
Route::get('/get-cylinder-by-supplier', [BookingController::class, 'getCylinderBySupplier'])->middleware('guest')->name('supplier.cylinder');

Route::get('/supplier/dashboard', [BookingController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::patch('/booking/update/status/{booking_id}', [BookingController::class, 'updateBookingStatus'])->middleware(['auth']);

// Route::get('/supplier/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Route::get('/home', )

require __DIR__.'/auth.php';
