<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingsMadeController extends Controller
{
    public function index(Request $request){
        $bookingsMade = $request->user()->bookings()->with('rent')->paginate(10)->withQueryString();
       
return Inertia('Activities/Rent/Index', ['bookings' =>$bookingsMade]);

    }
    public function update(Booking $bookings_made){
       $bookings_made->update([
        'status' => 'cancelled'
       ]);
        return redirect()->back()->with('success', 'Booking cancelled');
        
            }
}
