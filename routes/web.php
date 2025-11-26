<?php

use App\Http\Controllers\AcceptOfferController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingsMadeController;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\BuyImageController;
use App\Http\Controllers\BuyListingController;
use App\Http\Controllers\ConfirmBooking;
use App\Http\Controllers\DeclineBooking;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OfferMadeController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\RentImageController;
use App\Http\Controllers\RentListingController;
use App\Http\Controllers\UserAccount;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

 Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');
Route::name('offer.accept')->put('offer/{offer}/accept', AcceptOfferController::class)->middleware('auth');
Route::name('booking.confirm')->put('booking/{booking}/confirm', ConfirmBooking::class)->middleware('auth');
Route::name('booking.decline')->put('booking/{booking}/decline', DeclineBooking::class)->middleware('auth');
//  Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
//  })->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('cars', IndexController::class)->only(['index', 'show']);
Route::resource('buy', BuyController::class)->only(['show'])->withTrashed();
Route::resource('rent', RentController::class)->only(['show'])->withTrashed();
Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('signin', [AuthController::class, 'store'])->name('signin.store'); 
Route::resource('user-account', UserAccount::class)->only(['create', 'store']);
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');
Route::resource('owner-buy', BuyListingController::class)->middleware(['auth', 'verified'])->withTrashed();
Route::name('owner-buy.restore')->put('owner-buy/{owner_buy}/restore', [BuyListingController::class, 'restore'])->withTrashed()->middleware('auth');
Route::resource('owner-rent', RentListingController::class)->middleware(['auth', 'verified'])->withTrashed();
Route::name('owner-rent.restore')->put('owner-rent/{owner_rent}/restore', [RentListingController::class, 'restore'])->withTrashed()->middleware('auth');
Route::resource('buy.images', BuyImageController::class)->middleware(['auth', 'verified'])->only(['create', 'store', 'destroy']);
Route::resource('rent.images', RentImageController::class)->middleware(['auth', 'verified'])->only(['create', 'store', 'destroy']);
Route::resource('buy.offer', OfferController::class )->middleware(['auth', 'verified'])->only(['store']);
Route::resource('rent.booking', BookingController::class )->middleware(['auth', 'verified'])->only(['store']);
Route::resource('offers-made', OfferMadeController::class)->middleware(['auth', 'verified'])->only(['index', 'destroy']);
Route::resource('bookings-made', BookingsMadeController::class)->middleware(['auth', 'verified'])->only(['index', 'update']);
Route::resource('notifications', NotificationController::class)->middleware(['auth', 'verified'])->only(['index']);
Route::put('notification/{notification}/seen', NotificationSeenController::class)->middleware(['auth', 'verified'])->name('notification.seen');
// Route::get('/email/verify', function(){

// return inertia('auth/VerifyEmail');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
 
//     return redirect()->route('home')->with('success', 'Email verified');
// })->middleware(['auth', 'signed'])->name('verification.verify');
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
