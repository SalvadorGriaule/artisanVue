<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    public function all_product()
    {
        $res = Product::all();

        return response()->json($res);
    }

    public function product_by_id_seller(Request $request)
    {
        $res = Product::where('seller_id', $request->user()->id)->get();

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

        $path = $request->file('image')->storePublicly('product', 'public');

        $product = Product::create([
            'name' => $request->input('name'),
            'descritpion' => $request->input('descritpion'),
            'price' => $request->input('price'),
            'image' => $path,
            'seller_id' => $request->user()->id,
        ]);

        return redirect('/dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $target = Product::find($id);

        return Inertia::render('EditProduct', ['product' => $target]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', Rule::unique('products')->ignore($id)],
            'descritpion' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'image',
        ]);

        $product = Product::find($id);

        if (! empty($validated['image']) && $validated['image'] != 'undefined') {
            $path = $request->file('image')->storePublicly('product', 'public');
            $product->image = $path;
        }

        $product->name = $validated['name'];
        $product->descritpion = $validated['descritpion'];
        $product->price = $validated['price'];

        $product->save();

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $target = Product::find($id);

        if ($target['seller_id'] == $request->user()->id) {
            $target->delete();

            return response()->json([
                'result' => true,
            ]);
        }

        return response()->json([
            'result' => false,
            'msg' => 'non autorisé',
        ]);

    }
}
