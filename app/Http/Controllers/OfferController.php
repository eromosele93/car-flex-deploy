<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Offer;
use App\Notifications\OfferMade;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class OfferController extends Controller
{
    use AuthorizesRequests;
public function store(Buy $buy, Request $request, Offer $offer){

    $this->authorize('offer', $buy);
    $validatedData =  $request->validate([
        'amount' => 'required|integer|min:1|max:1000000000',
        
    ]);
$offer = $buy->offers()->create([
    'bidder_id' => $request->user()->id,
   'amount' => $validatedData['amount']
    ]);
$buy->user->notify(
    new OfferMade($offer)
);
    return redirect()->back()->with('success', 'Offer made successfully');
}
}
