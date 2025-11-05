<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function product_by_id_seller(Request $request) {
        $res = Product::where('seller_id',$request->user()->id)->get();
        
        return response()->json($res);
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
            'descritpion' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image',
        ]);
        
        $path = $request->file("image")->storePublicly("product","public");

        $product = Product::create([
            "name" => $request->input("name"),
            'descritpion' => $request->input("descritpion"),
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
