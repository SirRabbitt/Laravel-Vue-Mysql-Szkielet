<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\List_;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    use AuthorizesRequests;
  

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only([
            'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);
        $query = Listing::orderByDesc('created_at');

        if ($filters['priceFrom'] ?? false) {
            $query->where('price', '>=', $filters['priceFrom']);
        }

        if ($filters['priceTo'] ?? false) {
            $query->where('price', '<=', $filters['priceTo']);
        }

        if ($filters['beds'] ?? false) {
            $query->where('beds', $filters['beds']);
        }

        if ($filters['baths'] ?? false) {
            $query->where('baths', $filters['baths']);
        }

        if ($filters['areaFrom'] ?? false) {
            $query->where('area', '>=', $filters['areaFrom']);
        }

        if ($filters['areaTo'] ?? false) {
            $query->where('area', '<=', $filters['areaTo']);
        }

        return inertia(
            'Listing/index',
            [
                'filters' => $filters,
                'listings' => $query->paginate(10)
                ->withQueryString()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Listing::class);
        return inertia('Listing/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Listing::create(
            [...$request->all(),
                ...$request->validate([
                    'beds' => 'required|integer|min:0|max:20',
                    'baths' => 'required|integer|min:0|max:20',
                    'area' => 'required|integer|min:15|max:1500',
                    'city' => 'required',
                    'code' => 'required',
                    'street' => 'required',
                    'street_nr' => 'required|min:1|max:1000',
                    'price' => 'required|integer|min:1|max:20000000',
                ])
            ]
        );

        return redirect()->route('listing.index')->with('success', 'Listing was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
       

        return inertia(
            'Listing/show',
            ['listing' => $listing]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    { 
        $this->authorize('update', $listing);
        return inertia(
            'Listing/edit',
            ['listing' => $listing]
        );
    }
    
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $listing->update(
            $request->validate([
                'beds' => 'required|integer|min:0|max:20',
                'baths' => 'required|integer|min:0|max:20',
                'area' => 'required|integer|min:15|max:1500',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nr' => 'required|min:1|max:1000',
                'price' => 'required|integer|min:1|max:20000000',
            ])
        );

        return redirect()->route('listing.index')->with('success', 'Listing was updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $this->authorize('delete', $listing);
        $listing->delete();
        return redirect()->back()->with('success', 'Listing was deleted');
    }
}
