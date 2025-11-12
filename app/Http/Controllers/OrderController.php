<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Client_Order;

class OrderController extends Controller
{
    public function test() {}

    public function create(Request $request)
    {
        // $validated = $request->validate([
        //     'quantity' => 'required|integer|min:1',
        //     "product_id" => 'required|integer|exists:products,id'
        // ]);

        // $order = Order::create([
        //     'quantity' => $request->input("quantity"),
        //     ""
        // ]);
        $data = json_decode($request->collect());
        // foreach ($data as $sanitize) {
        //     Log::info($sanitize);
        //     array_push($san, $sanitize);
        // }
        

        $validator = Validator::make($data, [
            'row.*.quantity' => 'required|integer|min:1',
            'row.*.product_id' => 'required|integer|exists:products,id',
        ]);
        foreach ($request->collect() as $value) {
            Order::create([
                'quantity' => $value['quantity'],
                'product_id' => $value['product_id'],
            ]);
            $productId = Order::latest()->first();
            Client_Order::create([
                "user_id" => $request->user()->id,
                "order_id" => $productId->id
            ]);
        }

        return response()->json(['create' => true]);
    }
}
