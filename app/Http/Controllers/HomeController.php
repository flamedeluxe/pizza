<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'products' => [
                [
                    'id' => 1,
                    'count' => 0,
                    'title' => 'Carbonara',
                    'text' => 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
                    'image' => 'storage/images/pizza-1150031_640.jpg'
                ],
                [
                    'id' => 1,
                    'count' => 0,
                    'title' => 'Carbonara',
                    'text' => 'This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.',
                    'image' => 'storage/images/pizza-1150031_640.jpg'
                ]
            ]
        ];

        return view('welcome', $data);
    }
}
