<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class AcceptOfferController extends Controller
{
    public function __invoke(Offer $offer){
        //accept offer
$offer->update([
'accepted_at' => now()
]);
$offer->buy->sold_at = now();
$offer->buy->save();

//reject offers
$offer->buy->offers()->except($offer)->update([
'rejected_at' => now()
]);

return redirect()->back()->with('success', "Offer #{$offer->id} accepted, all others rejected");
    }
}
