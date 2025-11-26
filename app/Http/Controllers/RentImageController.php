<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\RentImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class RentImageController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
   
    public function create( Rent $rent)
    {
        $this->authorize('image', $rent);
        $rent->load(['rentImages']);
        return Inertia('Owner/Rent/Images/Create', ['rent' => $rent] ); 
    }

   
    public function store(Request $request, Rent $rent)
    {
        if($request->hasFile('images')){
            $request->validate([
                'images.*' => 'mimes:png,jpg,jpeg,webp|max:10000'

            ], ['images.*.mimes' => 'The file should be in jpg, jpeg or png format']);
            foreach ($request->file('images') as $file){
                $path = $file->store('images', 'public');
                $rent->rentImages()->save(new RentImage([
                    'filename' => $path
                ]));
            }
        }
        return redirect()->back()->with('success', 'Images Uploaded');
    }

  
   
    
    public function destroy(Rent $rent, RentImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();
        return redirect()->back()->with('success', 'Image deleted');
    }
}
