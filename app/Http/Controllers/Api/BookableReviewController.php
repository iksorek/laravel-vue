<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bookable;
use App\Models\Review;
use Illuminate\Http\Request;

class BookableReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($bookableId, Request $request)
    {
        $bookable = Bookable::findOrFail($bookableId);

        return $bookable->reviews()->latest()->get(['created_at', 'rating', 'content']);
    }
}
