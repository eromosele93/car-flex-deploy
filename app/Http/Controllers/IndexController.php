<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Rent;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type'); 



         if ($type === 'buy') {
            $filters = $request->only(['model', 'brand', 'year', 'priceFrom', 'priceTo', 'type', 'category']);
            $filters['brand'] = $search ?? $filters['brand'] ?? null;
             $results = Buy::where('brand', 'like', "%{$filters['brand']}%")->filterbuy($filters)->withoutSold()->with('buyImages')
             ->paginate(15)->withQueryString();
             return inertia(
                'Buy/Index',
        [   
            
            'buys'=> $results,
            'filters' => $filters,
        ]
        );   

         } elseif ($type === 'rent') {
            $filters = $request->only(['model', 'brand', 'year', 'rateFrom', 'rateTo', 'type', 'category']);
            $filters['brand'] = $search ?? $filters['brand'] ?? null;
             $results = Rent::where('brand', 'like', "%{$filters['brand']}%")->filterrent($filters)->with('rentImages')
             ->paginate(15)->withQueryString();

             return inertia(
                'Rent/Index',
        [   
            'rents'=> $results,
            'filters' => $filters,
        ]
        );   
         } 


        

    }
}
