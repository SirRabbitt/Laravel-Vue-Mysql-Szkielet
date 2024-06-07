<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseUnit;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }


        $filters = $request->only(['name', 'manufacturer', 'perPage']);
        $query = PurchaseUnit::orderBy('name');

        if ($filters['name'] ?? false) {
            $query->where('name', 'LIKE',  $filters['name'] . '%');
        }

        if ($filters['manufacturer'] ?? false) {
            $query->where('manufacturer', 'LIKE',  $filters['manufacturer'] . '%');
        }

        $perPage = $filters['perPage'] ?? 20;

        $purchaseUnits = $query->paginate($perPage)->withQueryString();

        
        $purchaseUnits->getCollection()->transform(function($unit) {
            if ($unit->purchase_units_type === 'szt') {
                $unit->total_units = ceil($unit->total_units / 400);
                $unit->purchase_units_type = 'pełna paleta';
            } elseif ($unit->purchase_units_type === 'paczka') {
                $unit->total_units = ceil($unit->total_units / 2);
                $unit->purchase_units_type = 'pełna paleta';
            }if ($unit->total_units >= 2) {
                $unit->purchase_units_type = 'pełne palety';
            }
            
            return $unit;
        });

        return inertia(
            'Listing/index',
            [
                'filters' => $filters,
                'listings' => $purchaseUnits
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     */
    public function show($purchase_unit_id)

    {
      
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $products = Product::where('purchase_unit_id', $purchase_unit_id)->get();
        
       
        $purchaseUnit = PurchaseUnit::find($purchase_unit_id);
    
        return inertia('Listing/show', [
            'products' => $products,
            'purchaseUnit' => $purchaseUnit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $listing)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $listing)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $listing)
    {
      
    }
}
