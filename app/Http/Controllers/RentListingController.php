<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RentListingController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request){
        $rents = $request->user()->rents()->withCount('rentImages')->withCount('bookings')->withTrashed()->paginate(6)->withQueryString();
       
       return inertia('Owner/Rent/Index', ['rents' => $rents]);
           }
    
    public function create(){
        return inertia('Owner/Rent/Create');
    } 

    public function store(Request $request){

        $request->user()->rents()->create(
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
                    'rate' => 'required|integer|min:1|max:20000000',
                ])
            
            );
        
              return redirect()->route('home')->with('success', 'Listing added successfully');
    }
    public function edit(Rent $owner_rent){
        $this->authorize('update', $owner_rent);
        return inertia('Owner/Rent/Edit', ['rent' => $owner_rent]);
        
            }
        
            public function update(Request $request, Rent $owner_rent){
                $this->authorize('update', $owner_rent);
        $owner_rent->update( $request->validate([
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
                    'rate' => 'required|integer|min:1|max:20000000',
        ]));
        
        return redirect()->route('owner-rent.index')
                    ->with('success', 'Listing was changed!');
            }

    public function show(Rent $owner_rent){
        $this->authorize('view', $owner_rent);

        return inertia('Owner/Rent/Show', 
        ['rent' => $owner_rent->load('bookings', 'bookings.renter')]
        );
    
    }
    public function destroy(Rent $owner_rent)
    {
        $this->authorize('delete', $owner_rent);
        $owner_rent->delete();

        return redirect()->back()->with('success', 'Listing deleted');
    }
    public function restore(Rent $owner_rent)
    {
        $this->authorize('restore', $owner_rent);
        $owner_rent->restore();

        return redirect()->back()->with('success', 'Listing was restored!');
    }
}
