<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $pizzas = [
            [
                'title' => 'MADISON',
                'text' => 'Prosciutto and housemade pineapple-jalapeño chutney on white.',
                'image' => 'images/pizza-1150031_640.jpg',
                'price' => 12
            ],
            [
                'title' => 'WHITAKER',
                'text' => 'Housemade pesto, garlic confit, cauliflower, and goat cheese.',
                'image' => 'images/pizza-1209748_640.jpg',
                'price' => 14
            ],
            [
                'title' => 'RIALTO',
                'text' => 'Housemade sausage, caramelized onion and goat cheese on organic crushed tomato.',
                'image' => 'images/pizza-1150031_640.jpg',
                'price' => 16
            ],
            [
                'title' => 'HIGGINS AVE',
                'text' => 'Crushed walnut, gorgonzola and red onion on white.',
                'image' => 'images/pizza-1209748_640.jpg',
                'price' => 11
            ],
            [
                'title' => 'MESSINA',
                'text' => 'Pickled pepper, ricotta, sopressata and fresh basil on organic crushed tomato.',
                'image' => 'images/pizza-1150031_640.jpg',
                'price' => 9
            ],
            [
                'title' => 'MACLAY',
                'text' => 'Crispy chicken, red onion, gorgonzola, celery and buffalo sauce on bbq.',
                'image' => 'images/pizza-1209748_640.jpg',
                'price' => 17
            ]
        ];

        foreach($pizzas as $item) {
            DB::table('products')->insert([
                'title' => $item['title'],
                'content' => $item['text'],
                'image' => $item['image'],
                'price' => $item['price'],
            ]);
        }

        $statuses = [
            [
                'title' => 'new',
                'is_default' => 1,
                'color' => 'yellow'
            ],
            [
                'title' => 'payed',
                'color' => 'orange'
            ],
            [
                'title' => 'delivery',
                'color' => 'blue'
            ],
            [
                'title' => 'completed',
                'color' => 'green'
            ]
        ];

        foreach($statuses as $item) {
            DB::table('statuses')->insert([
                'title' => $item['title'],
                'is_default' => $item['is_default'] ?? 0,
                'color' => $item['color'] ?? 0
            ]);
        }

        $payments = [
            [
                'title' => 'cash'
            ],
            [
                'title' => 'credit card'
            ]
        ];

        foreach($payments as $item) {
            DB::table('payments')->insert([
                'title' => $item['title'],
            ]);
        }

        $deliveries = [
            [
                'title' => 'carryout'
            ],
            [
                'title' => 'delivery'
            ]
        ];

        foreach($deliveries as $item) {
            DB::table('deliveries')->insert([
                'title' => $item['title'],
            ]);
        }
    }
}
