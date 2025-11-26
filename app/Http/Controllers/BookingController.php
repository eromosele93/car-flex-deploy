<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Notifications\BookingMade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class BookingController extends Controller
{
    use AuthorizesRequests;
    public function store(Rent $rent, Request $request){
        $this->authorize('booking', $rent);

        $validated = $request->validate([
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $overlap = $rent->bookings()
        ->where('status', 'confirmed')
        ->where(function ($query) use ($validated) {
            $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                  ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']])
                  ->orWhere(function ($query) use ($validated) {
                      $query->where('start_date', '<=', $validated['start_date'])
                            ->where('end_date', '>=', $validated['end_date']);
                  });
        })
        ->exists();

        if($overlap){
        
            return redirect()->back()->with('error', 'Car is already booked in that period');
        }
else{
         //  Calculate number of rental days
         $start = Carbon::parse($validated['start_date']);
         $end = Carbon::parse($validated['end_date']);
         $days = $start->diffInDays($end);
     
         // Ensure minimum 1 day
         $days = max($days, 1);
     
         // 💰 Calculate total amount
         $totalAmount = $rent->rate * $days;
     
       $booking =  $rent->bookings()->create([
             
             'renter_id' => $request->user()->id,
             'start_date' => $validated['start_date'],
             'end_date' => $validated['end_date'],
             'amount' => $totalAmount,
         ]);

         $rent->user->notify(
           new BookingMade($booking)
        );
         return redirect()->back()->with('success', 'Booking successful');
}
   
    }
}
