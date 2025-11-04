<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('CreateProduct');
    }
    
    /**
     * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:products',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image',
            'seller_id' => 'required|numeric|exists:users,id'
        ]);
        
        $path = $request->file("image")->storePublicly("product","public");

        $product = Product::create([
            "name" => $request->input("name"),
            'description' => $request->input("description"),
            'price' => $request->input("price"),
            'image' => $path,
            'seller_id' => $request->user()->id,
        ]);

        return redirect("/dashboard");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
