<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Status;
use App\Models\Product;
use TheSeer\Tokenizer\Exception;
use Throwable;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'surname' => ['required'],
                'phone' => ['required', 'regex:/^(?:\+\d{1,3}|0\d{1,3}|00\d{1,2})?(?:\s?\(\d+\))?(?:[-\/\s.]|\d)+$/'],
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
            'currency' => $request->input('currency'),
            'rate' => $request->input('rate'),
            'address' => $request->input('address'),
            'user_id' => $request->input('user.id') ?? null
        ]);

        $cart = json_decode($request->input('cart'));

        $total = 0;
        foreach ($cart as $item) {
            $order->products()->attach($item->id, [
                'count' => $item->quantity
            ]);
            $total += $item->price;
        }

        $order->total = $total;
        $order->save();

        $products = $order->products->toArray();
        $order = $order->toArray();
        $message_user = view('mail.user.order', compact(['order', 'products']));
        $message_admin = view('mail.admin.order', compact(['order', 'products']));

        try {
            self::email(
                $order['email'],
                "Your order #{$order['id']} have been received",
                $message_user
            );
            self::email(
                env('EMAIL_ORDERS'),
                "New order #{$order['id']} have been received",
                $message_admin
            );
        }catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        return response()->json([
            'status' => true,
            'message' => "Your order #{$order['id']} have been received"
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
        ]);

    }
}
