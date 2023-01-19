<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PassengerController;

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


//Flight routes
Route::get('/flights', [FlightController::class, 'index'])->middleware('admin')->name('flight.index');
Route::get('/flights/create', [FlightController::class, 'create'])->middleware('admin')->name('flight.create');
Route::post('/flights/insert', [FlightController::class, 'insert'])->middleware('admin')->name('flight.insert');
Route::get('/flights/edit/{id}', [FlightController::class, 'edit'])->middleware('admin')->name('flight.edit');
Route::post('/flights/update/{id}', [FlightController::class, 'update'])->middleware('admin')->name('flight.update');
Route::get('/flights/delete/{id}', [FlightController::class, 'delete'])->middleware('admin')->name('flight.delete');

//Passenger routes
Route::get('/', [PassengerController::class, 'index'])->name('passenger.index');
Route::get('/create', [PassengerController::class, 'create'])->name('passenger.create');
Route::post('/insert', [PassengerController::class, 'insert'])->name('passenger.insert');
Route::get('/view/{id}', [PassengerController::class, 'view'])->name('passenger.view');
Route::get('/edit/{id}', [PassengerController::class, 'edit'])->name('passenger.edit');
Route::post('/update/{id}', [PassengerController::class, 'update'])->name('passenger.update');
Route::get('/delete/{id}', [PassengerController::class, 'delete'])->name('passenger.delete');

//Admin routes
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/create-session', [AdminController::class, 'createSession'])->name('admin.create-session');