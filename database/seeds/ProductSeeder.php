<?php

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
        DB::table('products')->insert([
            [
                'category_id' => '1',
                'name' => 'Product 1',
                'slug' => 'product-1',
                'description' => 'Description 1',
                'price' => 1.5,
                'status' => 1,
                'quantity' => 1
            ],
            [
                'category_id'   => '2',
                'name'          => 'Product 2',
                'slug'          => 'product-2',
                'description'   => 'Description 2',
                'price'         => 2.5,
                'status'        => 1,
                'quantity'      => 1
            ],
            [
                'category_id'   => '1',
                'name'          => 'Product 3',
                'slug'          => 'product-3',
                'description'   => 'Description 3',
                'price'         => 3,
                'status'        => 1,
                'quantity'      => 1
            ],
            [
                'category_id'   => '2',
                'name'          => 'Product 4',
                'slug'          => 'product-4',
                'description'   => 'Description 4',
                'price'         => 2,
                'status'        => 1,
                'quantity'      => 1
            ],
            [
                'category_id'   => '3',
                'name'          => 'Product 5',
                'slug'          => 'product-5',
                'description'   => 'Description 5',
                'price'         => 1,
                'status'        => 1,
                'quantity'      => 1
            ],
            [
                'category_id'   => '4',
                'name'          => 'Product 6',
                'slug'          => 'product-6',
                'description'   => 'Description 6',
                'price'         => 4,
                'status'        => 1,
                'quantity'      => 1
            ]

        ]);
    }
}
