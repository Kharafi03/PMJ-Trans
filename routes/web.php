<?php

use App\Http\Controllers\Customer\BookingCheckController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\LoginController;
use App\Http\Controllers\Customer\RegistrationController;
use App\Http\Controllers\Customer\BookingController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\HistoryController;
use App\Http\Controllers\Customer\BookingCodeController;
use App\Http\Controllers\Customer\BookingStatusController;

// CUSTOMER

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegistrationController::class, 'register']);  
    

});
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/booking', [BookingController::class, 'showForm'])->name('frontend.booking.index');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

Route::get('/booking', [BookingController::class, 'showForm'])->name('frontend.booking.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/booking-code/{booking_code}', [BookingCodeController::class, 'show'])->name('booking.code');
});

Route::get('/booking-check', [BookingCheckController::class, 'index'])->name('cek.status');
Route::post('/booking-check', [BookingCheckController::class, 'status'])->name('post.cek.status');

Route::post('/booking/upload-proof/{id}', [BookingStatusController::class, 'uploadProof'])->name('booking.uploadProof');


Route::get('/', function () {
    return view('frontend.homepage');
})->name('homepage');

Route::get('/contact', function () {
    return view('frontend.contact.index');
})->name('contact');

// Route::get('/booking', function () {
//     return view('frontend.booking.index');
// })->name('booking');

Route::get('/booking-status', function () {
    return view('frontend.booking-status.index');
})->name('booking-status');

Route::get('/booking-accepted', function () {
    return view('frontend.booking-accepted.index');
})->name('booking-accepted');

Route::get('/booking-rejected', function () {
    return view('frontend.booking-rejected.index');
})->name('booking-rejected');

Route::get('/booking-processed', function () {
    return view('frontend.booking-processed.index');
})->name('booking-processed');

Route::get('/booking-details', function () {
    return view('frontend.booking-details.index');
})->name('booking-details');

Route::get('/faq', function () {
    return view('frontend.faq.index');
})->name('faq');

// Route::get('/customer-profile', function () {
//     return view('frontend.customer-profile.index');
// })->name('customer-profile');

// Route::get('/booking-history', function () {
//     return view('frontend.booking-history.index');
// })->name('booking-history');

Route::get('/payment', function () {
    return view('frontend.payment.index');
})->name('payment');

Route::get('/booking-payment', function () {
    return view('frontend.booking-payment.index');
})->name('booking-payment');

// Route::get('/booking-code', function () {
//     return view('frontend.booking-code.index');
// })->name('booking-code');

Route::get('/bus', function () {
    return view('frontend.bus.index');
})->name('bus');

Route::get('/about', function () {
    return view('frontend.about.index');
})->name('about');



// DRIVER
Route::get('/dashboard-driver', function () {
    return view('frontend.driver.dashboard-driver.index');
})->name('dashboard-driver');

Route::get('/qr-code', function () {
    return view('frontend.driver.qr-code.index');
})->name('qr-code');

Route::get('/km-awal', function () {
    return view('frontend.driver.km-awal.index');
})->name('km-awal');

Route::get('/input-data', function () {
    return view('frontend.driver.input-data.index');
})->name('input-data');

Route::get('/form-pengeluaran', function () {
    return view('frontend.driver.form-pengeluaran.index');
})->name('form-pengeluaran');

Route::get('/end-trip', function () {
    return view('frontend.driver.end-trip.index');
})->name('end-trip');


// AUTH
// Route::get('/login', function () {
//     return view('frontend.auth.login');
// })->name('login');
// Route::get('/register', function () {
//     return view('frontend.auth.register');
// })->name('register');