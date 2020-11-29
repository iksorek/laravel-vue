<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bookable;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookablePriceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     */
    public function __invoke($id, Request $request)
    {
        $bookable = Bookable::findOrFail($id);
        $data = $request->validate([
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d|after_or_equal:from',
        ]);
        $days = (new Carbon($data['from']))->diffInDays(new Carbon($data['to'])) +1;
        $price =  $bookable->price * $days;
        return response()->json([

        'total'=>$price,
            'beakdowan'=> [
                $bookable->price => $days,
            ]
        ]);

    }
}
