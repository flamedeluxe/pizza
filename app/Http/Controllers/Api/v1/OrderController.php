<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;

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
                'email' => ['required'],
                'address' => ['required']
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages()
            ])->setStatusCode('419');
        }

        Order::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Your order have been received'
        ]);
    }
}
