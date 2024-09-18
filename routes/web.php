<?php

use Illuminate\Support\Facades\Route;

// CUSTOMER
Route::get('/', function () {
    return view('frontend.homepage');
});

Route::get('/contact', function () {
    return view('frontend.contact.index');
})->name('contact');

Route::get('/booking', function () {
    return view('frontend.booking.index');
})->name('booking');

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

Route::get('/customer-profile', function () {
    return view('frontend.customer-profile.index');
})->name('customer-profile');

Route::get('/booking-history', function () {
    return view('frontend.booking-history.index');
})->name('booking-history');



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
Route::get('/login', function () {
    return view('frontend.auth.login');
})->name('login');
Route::get('/register', function () {
    return view('frontend.auth.register');
})->name('register');