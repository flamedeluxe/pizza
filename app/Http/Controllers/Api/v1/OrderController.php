<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Status;
use App\Models\Product;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'surname' => ['required'],
                'phone' => ['required'],
                'email' => ['required', 'email:rfc'],
                'address' => ['required']
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages()
            ])->setStatusCode('419');
        }

        $order = Order::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'user_id' => $request->input('user.id') ?? null
        ]);

        $cart = json_decode($request->input('cart'));

        foreach ($cart as $item) {
            $order->products()->attach($item->id, [
                'count' => $item->quantity
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Your order have been received'
        ]);
    }

    public function list(Request $request)
    {

        $orders = Order::where([
            'user_id' => Auth::id(),
        ])
            ->with('products', 'status', 'delivery', 'payment')
            ->get();

        return response()->json([
            'status' => true,
            'orders' => $orders
        ], 200);

    }
}
