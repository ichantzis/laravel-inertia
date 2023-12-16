<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{

    // add ListingPolicy
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    // alternate method to add middleware by adding a constructor
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index', 'show']);
    // }
    /** 
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);

        return inertia(
            'Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::mostRecent()-> //get queries from Listing Model -> scopeMostRecent
                    filter($filters) //get queries from Listing Model -> scopeFilters
                    ->withoutSold()
                    ->paginate(10)
                    ->withQueryString()
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {

        $listing->load(['images']);
        $offer = !Auth::user() ? null : $listing->offers()->byMe()->first();

        return inertia(
            'Listing/Show',
            [
                'listing' => $listing,
                'offerMade' => $offer
            ]
        );
    }

    
    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Listing $listing)
    // {
    //     $listing->delete();

    //     return redirect()->back()
    //         ->with('success', 'Listing was deleted!');
    // }
}
