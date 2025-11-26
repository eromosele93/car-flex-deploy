<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\BuyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class BuyImageController extends Controller
{
    use AuthorizesRequests;
    
    public function create(Buy $buy)
    {
        $this->authorize('image', $buy);
        $buy->load(['buyImages']);
        return Inertia('Owner/Buy/Images/Create', ['buy' => $buy] );
    }

    
    public function store(Request $request, Buy $buy)
    {
        if($request->hasFile('images')){
            $request->validate([
                'images.*' => 'mimes:png,jpg,jpeg,webp|max:10000'

            ], ['images.*.mimes' => 'The file should be in jpg, jpeg or png format']);
            foreach ($request->file('images') as $file){
                $path = $file->store('images', 'public');
                $buy->buyImages()->save(new BuyImage([
                    'filename' => $path
                ]));
            }
        }
        return redirect()->back()->with('success', 'Images Uploaded');
    }

    public function destroy(Buy $buy ,BuyImage $image)
    {
        Storage::disk('public')->delete($image->filename);
$image->delete();
return redirect()->back()->with('success', 'Image deleted');
    
    }
}
