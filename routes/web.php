<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Middleware\RoleMiddleware;


Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/home', function () {
    return view('frontend.home');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/bus', [BusController::class, 'index'])->name('admin.bus.index');
    Route::get('/admin/bus/create', [BusController::class, 'create'])->name('admin.bus.create');
    Route::post('/admin/bus/store', [BusController::class, 'store'])->name('admin.bus.store');
    Route::get('/admin/bus/edit/{bus}', [BusController::class, 'edit'])->name('admin.bus.edit');
    Route::put('/admin/bus/update/{vehicle}', [BusController::class, 'update'])->name('admin.bus.update');
    Route::match(['get', 'post'], '/admin/bus/edit/{bus}/edit-gambar/{gambar}', [BusController::class, 'editGambar'])->name('admin.bus.edit_gambar');
    Route::match(['get', 'post'], '/admin/bus/edit/{bus}/update-gambar/{gambar}', [BusController::class, 'updateGambar'])->name('admin.bus.update_gambar');
    Route::delete('/admin/bus/{bus}', [BusController::class, 'destroy'])->name('admin.bus.destroy');

    Route::get('/admin/driver', [DriverController::class, 'index'])->name('admin.driver.index');
    Route::get('/admin/driver/create', [DriverController::class, 'create'])->name('admin.driver.create');
    Route::post('/admin/driver/store', [DriverController::class, 'store'])->name('admin.driver.store');
    Route::get('/admin/driver/edit/{driver}', [DriverController::class, 'edit'])->name('admin.driver.edit');
    Route::put('/admin/driver/update/{driver}', [DriverController::class, 'update'])->name('admin.driver.update');
    Route::match(['get', 'post'], '/admin/driver/edit/{driver}/edit-gambar/{gambar}', [DriverController::class, 'editGambar'])->name('admin.driver.edit_gambar');
    Route::match(['get', 'post'], '/admin/driver/edit/{driver}/update-gambar/{gambar}', [DriverController::class, 'updateGambar'])->name('admin.driver.update_gambar');
    Route::delete('/admin/driver/{driver}', [DriverController::class, 'destroy'])->name('admin.driver.destroy');
});