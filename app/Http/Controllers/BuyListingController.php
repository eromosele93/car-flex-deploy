<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class BuyListingController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request){
      
        
$buys = $request->user()->buys()->withCount('buyImages')->withCount('offers')->withTrashed()->paginate(6)->withQueryString();

return inertia('Owner/Buy/Index', ['buys' => $buys]);
    }

    public function show(Buy $owner_buy){
        $this->authorize('view', $owner_buy);
        return inertia('Owner/Buy/Show', 
    ['buy' => $owner_buy->load('offers', 'offers.bidder')]
    );

    }
    public function create(){
        
       
        return inertia('Owner/Buy/Create');
    } 

    public function store(Request $request){

        $request->user()->buys()->create(
            $request->validate([
                    'brand' => 'required',
                    'year' => [
                        'required',
                        'integer',
                        'min:1900',             
                        'max:' . date('Y') + 1  
                    ],
                    'model' => 'required',
                    'type' => 'required',
                    'category' => 'required',
                    'colour' => 'required',
                    'price' => 'required|integer|min:1|max:20000000',
                ])
            
            );
        
              return redirect()->route('owner-buy.index')->with('success', 'Listing added successfully');
    }
    public function edit(Buy $owner_buy){
        $this->authorize('update', $owner_buy);
return inertia('Owner/Buy/Edit', ['buy' => $owner_buy]);

    }

    public function update(Request $request, Buy $owner_buy){
        $this->authorize('update', $owner_buy);
$owner_buy->update( $request->validate([
    'brand' => 'required',
    'year' => [
        'required',
        'integer',
        'min:1900',             
        'max:' . date('Y') + 1  
    ],
    'model' => 'required',
    'type' => 'required',
    'category' => 'required',
    'colour' => 'required',
    'price' => 'required|integer|min:1|max:20000000',
]));

return redirect()->route('owner-buy.index')
            ->with('success', 'Listing was changed!');
    }
    public function destroy(Buy $owner_buy)
    {
        $this->authorize('delete', $owner_buy);
        $owner_buy->delete();

        return redirect()->back()->with('success', 'Listing deleted');
    }
    public function restore(Buy $owner_buy)
    {
        $this->authorize('restore', $owner_buy);
        $owner_buy->restore();

        return redirect()->back()->with('success', 'Listing was restored!');
    }
}
