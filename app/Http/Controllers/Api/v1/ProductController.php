<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => ['required'],
                'content' => ['required'],
                'price' => ['required']
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages()
            ]);
        }

        Product::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'price' => $request->input('price')
        ]);

        return response()->json([
            'status' => true,
            'message' => 'created'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if(!is_object($product)) {
            return response()->json([
                'status' => false,
                'message' => 'Not found 404'
            ])->setStatusCode(404);
        }

        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if(!is_object($product)) {
            return response()->json([
                'status' => false,
                'message' => 'Not found 404'
            ])->setStatusCode(404);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'title' => ['required'],
                'content' => ['required']
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages()
            ]);
        }

        $product->title = $request->input('title');
        $product->title = $request->input('content');
        $product->price = $request->input('price');
        $product->save();

        return response()->json([
            'status' => true,
            'message' => 'updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(!is_object($product)) {
            return response()->json([
                'status' => false,
                'message' => 'Not found 404'
            ])->setStatusCode(404);
        }

        $product->destroy();
    }
}
