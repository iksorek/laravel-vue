<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class myReviewsController extends Controller
{


    public function index()
    {
        $toBeReviewed = Booking::where('user_id', Auth::id())->where('review_key', '!=', '')->get();
        return $toBeReviewed;

    }
}
