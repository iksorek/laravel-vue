<?php

use App\Http\Controllers\Api\BookableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookableAvailabilityController;
use App\Http\Controllers\Api\BookableReviewController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\BookingByReviewController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


Route::apiResource('bookables', BookableController::class);

Route::get('bookables/{bookable}/availability', BookableAvailabilityController::class)
    ->name('bookables.availability.show');

Route::get('bookables/{bookable}/reviews', BookableReviewController::class)
    ->name('bookables.reviews.index');

Route::apiResource('reviews', ReviewController::class)->only(['show', 'store']);

Route::get('booking-by-review/{reviewKey}', BookingByReviewController::class)->name('booking-by-review.show');