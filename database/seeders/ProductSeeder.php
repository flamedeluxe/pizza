<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'title' => Str::random(10),
            'content' => Str::random(240),
            'image' => 'storage/images/pizza-1150031_640.jpg',
        ]);
    }
}
