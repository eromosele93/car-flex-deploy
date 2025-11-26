<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class ConfirmBooking extends Controller
{
    public function __invoke(Booking $booking){
      
$booking->update([
'status' => "confirmed"
]);
return redirect()->back()->with('success', "booking #{$booking->id} has been confirmed");
}

}
