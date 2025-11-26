<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\BuyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BuyController extends Controller
{ 
   
    public function show(Buy $buy)
    {
     
     

       
        $buy->load(['buyImages']);   
        $offer = !Auth::user()? null : $buy->offers()->byMe()->first();
        return inertia('Buy/Show',
        [
           'buy' => $buy,
           'offerMade' => $offer
        ]
        );
    }

}
