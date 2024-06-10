<?php
namespace App\Http\Controllers;

use App\Models\Product;
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
        $query = Product::orderBy('name');

        if ($filters['name'] ?? false) {
            $query->where('name', 'LIKE',  $filters['name'] . '%');
        }

        if ($filters['manufacturer'] ?? false) {
            $query->where('manufacturer', 'LIKE',  $filters['manufacturer'] . '%');
        }

        $perPage = $filters['perPage'] ?? 20;

        $products = $query->paginate($perPage)->withQueryString();

        return inertia(
            'Listing/index',
            [
                'filters' => $filters,
                'listings' => $products
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Implementacja formularza tworzenia nowego produktu
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Implementacja przechowywania nowego produktu
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('products.index')->withErrors(['Product not found']);
        }

        return inertia('Listing/show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Implementacja formularza edycji produktu
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Implementacja aktualizacji produktu
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Implementacja usuwania produktu
    }
}
