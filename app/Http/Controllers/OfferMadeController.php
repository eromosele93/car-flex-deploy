<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OfferMadeController extends Controller
{
    public function index(Request $request){
        $offersMade = $request->user()->offers()->paginate(10)->withQueryString();
return Inertia('Activities/Buy/Index', ['offers' =>$offersMade]);

    }

    public function destroy(Offer $offers_made){
$offers_made->delete();
return redirect()->back()->with('success', 'Offer cancelled');

    }
}
