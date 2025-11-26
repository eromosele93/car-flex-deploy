<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    
    public function show(Rent $rent)
    {
        $rent->load(['rentImages']);  
        return inertia('Rent/Show',
        [
           'rent' => $rent,
           
        ]
        );
    }
}
