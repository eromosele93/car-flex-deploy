<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class DeclineBooking extends Controller
{
    public function __invoke(Booking $booking){
      
        $booking->update([
        'status' => "declined"
        ]);
        return redirect()->back()->with('success', "booking #{$booking->id} was declined");
        }
        
}
